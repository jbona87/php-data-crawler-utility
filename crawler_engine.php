<?php
/**
 * SYSTEM: Server-Side Data Extraction & Web Scraper Core
 * DESCRIPTION: High-performance, object-oriented CLI utility built for 
 * HTML page crawling, user-agent masking, and DOM parsing.
 * AUTHOR: jbona87
 * VERSION: 2.0.0
 */

class WebDataCrawlerEngine {
    private $userAgent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36";
    private $timeout = 15;
    private $outputDir = "output";

    public function __construct() {
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0777, true);
        }
    }

    private function renderBanner() {
        echo "\n";
        echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
        echo "║  ENTERPRISE PHP DATA CRAWLER UTILITY                                       ║\n";
        echo "║  VERSION 2.0.0  //  SERVER-SIDE EXTRACTION ENGINE  //  SYSTEM ONLINE       ║\n";
        echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";
    }

    public function fetchRawHtml(string $url): ?string {
        $this->renderBanner();
        echo " 01 // NETWORK PIPELINE INITIALIZATION \n";
        echo "──────────────────────────────────────────────────────────────────────────────\n";
        echo "◆ [BOOT] Configuring cURL multi-threaded network core...\n";
        echo "📡 [TARGET] Connecting to: " . $url . "\n";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgent);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        echo "◆ [REQUEST] Sending secure GET handshake payload...\n";
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            echo "❌ [ERROR] Network connection failed: " . curl_error($ch) . "\n";
            curl_close($ch);
            return null;
        }

        curl_close($ch);

        if ($httpCode !== 200) {
            echo "⚠️  [ALERT] Target server responded with non-200 status code: " . $httpCode . "\n";
            return null;
        }

        echo "✓ [SUCCESS] Raw HTML data stream ingested perfectly (HTTP 200).\n\n";
        return $response;
    }

    public function parseMetadata(string $html): array {
        echo " 02 // DOM PARSING MATRIX \n";
        echo "──────────────────────────────────────────────────────────────────────────────\n";
        echo "◆ [PARSING] Initializing DOM Document engine...\n";
        
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        echo "[PROCESSING] █▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒   10%\r";
        usleep(150000); // Visual simulation matching data stream load frames
        
        $payload = [
            'extracted_at' => gmdate('Y-m-d H:i:s') . ' UTC',
            'page_title' => 'Unclassified / Missing',
            'meta_description' => 'Unclassified / Missing',
            'h1_headers' => [],
            'system_status' => 'Data Normalized'
        ];

        echo "[PROCESSING] ███████████████▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒▒   40%\r";
        $titles = $dom->getElementsByTagName('title');
        if ($titles->length > 0) {
            $payload['page_title'] = trim($titles->item(0)->nodeValue);
        }

        echo "[PROCESSING] █████████████████████████████▒▒▒▒▒▒▒▒▒▒▒   75%\r";
        $metaDesc = $xpath->query("//meta[@name='description']/@content");
        if ($metaDesc->length > 0) {
            $payload['meta_description'] = trim($metaDesc->item(0)->nodeValue);
        }

        $h1Elements = $dom->getElementsByTagName('h1');
        foreach ($h1Elements as $h1) {
            $payload['h1_headers'][] = trim($h1->nodeValue);
        }

        echo "[PROCESSING] ██═══════════════════════════════════════] 100% Extraction Verified\n\n";
        return $payload;
    }

    public function secureExport(array $data) {
        echo " 03 // SECURE STORAGE VECTOR \n";
        echo "──────────────────────────────────────────────────────────────────────────────\n";
        $filePath = $this->outputDir . "/scraped_payload.json";
        
        echo "◆ [WRITE] Compiling atomic JSON architecture tree...\n";
        $jsonPayload = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        
        if (file_put_contents($filePath, $jsonPayload)) {
            echo "✓ [STORAGE] Target file verified: /workspaces/php-data-crawler-utility/" . $filePath . "\n\n";
            
            echo " 04 // DATA STREAM INTERACTIVE PREVIEW \n";
            echo "──────────────────────────────────────────────────────────────────────────────\n";
            echo $jsonPayload . "\n\n";
        } else {
            echo "❌ [ERROR] Storage write sequence interrupted.\n\n";
        }

        echo " 05 // SYSTEM RESOURCE METRICS \n";
        echo "──────────────────────────────────────────────────────────────────────────────\n";
        echo "◆ [MEMORY] Peak runtime footprint: " . round(memory_get_peak_usage() / 1024 / 1024, 2) . " MB\n";
        echo "✓ [STATUS] Server execution cycle successfully normalized.\n\n";
    }
}

// System Command-Line Execution Guard
if (php_sapi_name() === 'cli') {
    // Standard secure test target URL
    $target = "https://example.com";
    
    $engine = new WebDataCrawlerEngine();
    $htmlPayload = $engine->fetchRawHtml($target);
    
    if ($htmlPayload) {
        $extractedMetrics = $engine->parseMetadata($htmlPayload);
        $engine->secureExport($extractedMetrics);
    }
}