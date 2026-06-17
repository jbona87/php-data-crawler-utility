```php
<?php

declare(strict_types=1);

/**
 * System Name: Enterprise PHP Data Crawler Core
 *
 * Description:
 *   Secure server-side crawler for HTML extraction, HTTP inspection,
 *   DOM parsing and technical SEO intelligence generation.
 *
 * Author: jbona87
 * Version: 2.0.0
 *
 * Requirements:
 *   - PHP 8.0+
 *   - cURL extension
 *   - DOM / libxml extension
 */


/* ==========================================================================
   01 // SYSTEM CONFIGURATION
   ========================================================================== */

final class CrawlerConfig
{
    public function __construct(
        public string $userAgent = 'JBona87-SEO-Crawler/2.0',
        public int $connectTimeout = 8,
        public int $requestTimeout = 20,
        public int $maxRedirects = 5,
        public int $maxResponseBytes = 5_000_000,
        public bool $allowPrivateNetworks = false,
        public bool $pinResolvedIp = true,
        public array $allowedPorts = [80, 443]
    ) {
    }
}


/* ==========================================================================
   02 // TERMINAL DESIGN SYSTEM
   ========================================================================== */

final class TerminalUI
{
    private const RESET = "\033[0m";
    private const BOLD = "\033[1m";
    private const DIM = "\033[2m";

    private const CYAN = "\033[96m";
    private const PURPLE = "\033[95m";
    private const GREEN = "\033[92m";
    private const YELLOW = "\033[93m";
    private const RED = "\033[91m";
    private const WHITE = "\033[97m";
    private const GREY = "\033[90m";

    private bool $coloursEnabled;

    public function __construct(?bool $coloursEnabled = null)
    {
        $this->coloursEnabled = $coloursEnabled ?? $this->supportsColours();
    }

    public function banner(): void
    {
        $width = 78;

        echo PHP_EOL;
        echo $this->colour(
            '╔' . str_repeat('═', $width) . '╗',
            self::CYAN
        ) . PHP_EOL;

        echo $this->colour('║', self::CYAN);
        echo $this->colour(
            str_pad(
                '  ENTERPRISE PHP DATA CRAWLER CORE',
                $width
            ),
            self::BOLD,
            self::WHITE
        );
        echo $this->colour('║', self::CYAN) . PHP_EOL;

        echo $this->colour('║', self::CYAN);
        echo $this->colour(
            str_pad(
                '  VERSION 2.0.0  //  SECURE EXTRACTION  //  DOM INTELLIGENCE',
                $width
            ),
            self::PURPLE
        );
        echo $this->colour('║', self::CYAN) . PHP_EOL;

        echo $this->colour(
            '╚' . str_repeat('═', $width) . '╝',
            self::CYAN
        ) . PHP_EOL;

        echo PHP_EOL;
    }

    public function section(string $number, string $title): void
    {
        echo $this->colour(
            sprintf(' %s // %s ', $number, strtoupper($title)),
            self::BOLD,
            self::PURPLE
        ) . PHP_EOL;

        echo $this->colour(
            str_repeat('─', 80),
            self::GREY
        ) . PHP_EOL;
    }

    public function info(string $label, string $message): void
    {
        $this->status('◆', $label, $message, self::CYAN);
    }

    public function success(string $label, string $message): void
    {
        $this->status('✓', $label, $message, self::GREEN);
    }

    public function warning(string $label, string $message): void
    {
        $this->status('!', $label, $message, self::YELLOW);
    }

    public function error(string $label, string $message): void
    {
        $this->status('✕', $label, $message, self::RED);
    }

    public function metric(
        string $label,
        string|int|float $value
    ): void {
        echo sprintf(
            "  %s %-28s %s%s%s\n",
            $this->colour('▸', self::PURPLE),
            $label,
            $this->colour((string) $value, self::BOLD, self::WHITE),
            '',
            ''
        );
    }

    public function footer(): void
    {
        echo PHP_EOL;

        echo $this->colour(
            '  RAW HTML IN  //  STRUCTURED WEB INTELLIGENCE OUT',
            self::BOLD,
            self::CYAN
        ) . PHP_EOL;

        echo PHP_EOL;
    }

    private function status(
        string $icon,
        string $label,
        string $message,
        string $colour
    ): void {
        echo sprintf(
            "%s %s %s\n",
            $this->colour($icon, self::BOLD, $colour),
            $this->colour(
                '[' . strtoupper($label) . ']',
                self::BOLD,
                $colour
            ),
            $message
        );
    }

    private function colour(string $text, string ...$styles): string
    {
        if (!$this->coloursEnabled) {
            return $text;
        }

        return implode('', $styles) . $text . self::RESET;
    }

    private function supportsColours(): bool
    {
        if (!defined('STDOUT')) {
            return false;
        }

        if (function_exists('stream_isatty')) {
            return stream_isatty(STDOUT);
        }

        if (function_exists('posix_isatty')) {
            return posix_isatty(STDOUT);
        }

        return false;
    }
}


/* ==========================================================================
   03 // STRUCTURED RESPONSE MODEL
   ========================================================================== */

final class HttpResponse
{
    public function __construct(
        public readonly string $requestedUrl,
        public readonly string $finalUrl,
        public readonly int $statusCode,
        public readonly string $contentType,
        public readonly string $body,
        public readonly array $headers,
        public readonly int $responseBytes,
        public readonly float $durationMilliseconds,
        public readonly int $redirectCount,
        public readonly string $remoteIp
    ) {
    }
}


/* ==========================================================================
   04 // FILE LOGGING ENGINE
   ========================================================================== */

final class CrawlerLogger
{
    public function __construct(
        private readonly string $logFile = 'crawler.log'
    ) {
    }

    public function write(
        string $level,
        string $message,
        array $context = []
    ): void {
        $directory = dirname($this->logFile);

        if (
            $directory !== '.' &&
            !is_dir($directory)
        ) {
            mkdir($directory, 0775, true);
        }

        $logEntry = sprintf(
            "[%s] [%s] %s %s%s",
            gmdate('Y-m-d\TH:i:s\Z'),
            strtoupper($level),
            $message,
            $context !== []
                ? json_encode(
                    $context,
                    JSON_UNESCAPED_SLASHES |
                    JSON_UNESCAPED_UNICODE
                )
                : '',
            PHP_EOL
        );

        file_put_contents(
            $this->logFile,
            $logEntry,
            FILE_APPEND | LOCK_EX
        );
    }
}


/* ==========================================================================
   05 // ENTERPRISE CRAWLER ENGINE
   ========================================================================== */

final class WebDataCrawlerEngine
{
    public function __construct(
        private readonly CrawlerConfig $config,
        private readonly TerminalUI $terminal,
        private readonly CrawlerLogger $logger
    ) {
        if (!extension_loaded('curl')) {
            throw new RuntimeException(
                'The PHP cURL extension is required.'
            );
        }

        if (!class_exists(DOMDocument::class)) {
            throw new RuntimeException(
                'The PHP DOM extension is required.'
            );
        }
    }

    /**
     * Runs the complete extraction and parsing pipeline.
     */
    public function crawl(string $url): array
    {
        $startedAt = microtime(true);

        $this->terminal->banner();

        $this->terminal->section(
            '01',
            'secure extraction pipeline'
        );

        $this->terminal->info(
            'TARGET',
            $url
        );

        $response = $this->fetchRawHtml($url);

        $this->terminal->success(
            'HTTP',
            sprintf(
                'Server responded with HTTP %d',
                $response->statusCode
            )
        );

        $this->terminal->success(
            'STREAM',
            sprintf(
                '%s received',
                $this->formatBytes($response->responseBytes)
            )
        );

        $this->terminal->section(
            '02',
            'DOM parsing matrix'
        );

        $metadata = $this->parseMetadata(
            $response->body,
            $response->finalUrl
        );

        $this->terminal->success(
            'DOM',
            'HTML document parsed successfully'
        );

        $this->terminal->success(
            'SEO',
            'Metadata boundaries normalised'
        );

        $totalDuration = round(
            (microtime(true) - $startedAt) * 1000,
            2
        );

        $result = [
            'system' => [
                'engine' => 'Enterprise PHP Data Crawler Core',
                'version' => '2.0.0',
                'processed_at' => gmdate(DATE_ATOM),
                'pipeline_status' => 'Completed'
            ],

            'request' => [
                'requested_url' => $response->requestedUrl,
                'final_url' => $response->finalUrl,
                'http_status' => $response->statusCode,
                'content_type' => $response->contentType,
                'response_bytes' => $response->responseBytes,
                'remote_ip' => $response->remoteIp,
                'redirects_followed' => $response->redirectCount,
                'request_duration_ms' =>
                    $response->durationMilliseconds,
                'pipeline_duration_ms' => $totalDuration
            ],

            'seo_intelligence' => $metadata
        ];

        $this->renderSummary(
            $response,
            $metadata,
            $totalDuration
        );

        $this->logger->write(
            'success',
            'Crawler pipeline completed',
            [
                'url' => $response->finalUrl,
                'status' => $response->statusCode,
                'bytes' => $response->responseBytes,
                'duration_ms' => $totalDuration
            ]
        );

        return $result;
    }

    /**
     * Fetches raw HTML while validating every redirect destination.
     */
    public function fetchRawHtml(string $url): HttpResponse
    {
        $originalUrl = trim($url);
        $currentUrl = $originalUrl;
        $redirectCount = 0;

        while (true) {
            $validatedTarget = $this->validateTargetUrl(
                $currentUrl
            );

            $this->terminal->info(
                'CONNECT',
                sprintf(
                    '%s → %s',
                    $validatedTarget['host'],
                    $validatedTarget['ip']
                )
            );

            $response = $this->executeHttpRequest(
                $currentUrl,
                $validatedTarget,
                $originalUrl,
                $redirectCount
            );

            if (
                $response->statusCode >= 300 &&
                $response->statusCode < 400
            ) {
                $location = $response->headers['location'] ?? '';

                if ($location === '') {
                    throw new RuntimeException(
                        sprintf(
                            'HTTP %d returned without a Location header.',
                            $response->statusCode
                        )
                    );
                }

                if (
                    $redirectCount >=
                    $this->config->maxRedirects
                ) {
                    throw new RuntimeException(
                        'Maximum redirect limit exceeded.'
                    );
                }

                $nextUrl = $this->resolveRedirectUrl(
                    $currentUrl,
                    $location
                );

                $redirectCount++;

                $this->terminal->warning(
                    'REDIRECT',
                    sprintf(
                        '%d/%d → %s',
                        $redirectCount,
                        $this->config->maxRedirects,
                        $nextUrl
                    )
                );

                $currentUrl = $nextUrl;

                continue;
            }

            if (
                $response->statusCode < 200 ||
                $response->statusCode >= 300
            ) {
                throw new RuntimeException(
                    sprintf(
                        'Target returned HTTP status %d.',
                        $response->statusCode
                    )
                );
            }

            if (
                $response->contentType !== '' &&
                !$this->isHtmlContentType(
                    $response->contentType
                )
            ) {
                throw new RuntimeException(
                    sprintf(
                        'Expected HTML but received "%s".',
                        $response->contentType
                    )
                );
            }

            return new HttpResponse(
                requestedUrl: $originalUrl,
                finalUrl: $currentUrl,
                statusCode: $response->statusCode,
                contentType: $response->contentType,
                body: $response->body,
                headers: $response->headers,
                responseBytes: $response->responseBytes,
                durationMilliseconds:
                    $response->durationMilliseconds,
                redirectCount: $redirectCount,
                remoteIp: $response->remoteIp
            );
        }
    }

    /**
     * Performs one validated HTTP request.
     */
    private function executeHttpRequest(
        string $url,
        array $validatedTarget,
        string $originalUrl,
        int $redirectCount
    ): HttpResponse {
        $handle = curl_init();

        if ($handle === false) {
            throw new RuntimeException(
                'Unable to initialise cURL.'
            );
        }

        $responseBody = '';
        $responseHeaders = [];
        $maximumSizeExceeded = false;

        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_FOLLOWLOCATION => false,

            CURLOPT_CONNECTTIMEOUT =>
                $this->config->connectTimeout,

            CURLOPT_TIMEOUT =>
                $this->config->requestTimeout,

            CURLOPT_USERAGENT =>
                $this->config->userAgent,

            CURLOPT_ENCODING => '',
            CURLOPT_NOSIGNAL => true,

            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,

            CURLOPT_PROTOCOLS =>
                CURLPROTO_HTTP | CURLPROTO_HTTPS,

            CURLOPT_REDIR_PROTOCOLS =>
                CURLPROTO_HTTP | CURLPROTO_HTTPS,

            CURLOPT_HTTPHEADER => [
                'Accept: text/html,application/xhtml+xml;q=0.9,*/*;q=0.5',
                'Accept-Language: en-US,en;q=0.8',
                'Cache-Control: no-cache',
                'Pragma: no-cache'
            ],

            CURLOPT_HEADERFUNCTION =>
                function (
                    $curlHandle,
                    string $headerLine
                ) use (&$responseHeaders): int {
                    $lineLength = strlen($headerLine);
                    $trimmedLine = trim($headerLine);

                    if (
                        preg_match(
                            '/^HTTP\/\S+\s+\d+/i',
                            $trimmedLine
                        )
                    ) {
                        $responseHeaders = [];

                        return $lineLength;
                    }

                    if (
                        $trimmedLine === '' ||
                        !str_contains($trimmedLine, ':')
                    ) {
                        return $lineLength;
                    }

                    [$name, $value] = explode(
                        ':',
                        $trimmedLine,
                        2
                    );

                    $responseHeaders[
                        strtolower(trim($name))
                    ] = trim($value);

                    return $lineLength;
                },

            CURLOPT_WRITEFUNCTION =>
                function (
                    $curlHandle,
                    string $chunk
                ) use (
                    &$responseBody,
                    &$maximumSizeExceeded
                ): int {
                    $newSize =
                        strlen($responseBody) +
                        strlen($chunk);

                    if (
                        $newSize >
                        $this->config->maxResponseBytes
                    ) {
                        $maximumSizeExceeded = true;

                        return 0;
                    }

                    $responseBody .= $chunk;

                    return strlen($chunk);
                }
        ];

        if ($this->config->pinResolvedIp) {
            $resolvedIp = str_contains(
                $validatedTarget['ip'],
                ':'
            )
                ? '[' . $validatedTarget['ip'] . ']'
                : $validatedTarget['ip'];

            $curlOptions[CURLOPT_RESOLVE] = [
                sprintf(
                    '%s:%d:%s',
                    $validatedTarget['host'],
                    $validatedTarget['port'],
                    $resolvedIp
                )
            ];
        }

        curl_setopt_array(
            $handle,
            $curlOptions
        );

        $executionResult = curl_exec($handle);

        $curlErrorNumber = curl_errno($handle);
        $curlErrorMessage = curl_error($handle);

        $statusCode = (int) curl_getinfo(
            $handle,
            CURLINFO_HTTP_CODE
        );

        $contentType = (string) (
            curl_getinfo(
                $handle,
                CURLINFO_CONTENT_TYPE
            ) ?: ''
        );

        $remoteIp = (string) (
            curl_getinfo(
                $handle,
                CURLINFO_PRIMARY_IP
            ) ?: $validatedTarget['ip']
        );

        $durationMilliseconds = round(
            (float) curl_getinfo(
                $handle,
                CURLINFO_TOTAL_TIME
            ) * 1000,
            2
        );

        curl_close($handle);

        if ($maximumSizeExceeded) {
            throw new RuntimeException(
                sprintf(
                    'Response exceeded the maximum size of %s.',
                    $this->formatBytes(
                        $this->config->maxResponseBytes
                    )
                )
            );
        }

        if (
            $executionResult === false ||
            $curlErrorNumber !== 0
        ) {
            throw new RuntimeException(
                sprintf(
                    'cURL error %d: %s',
                    $curlErrorNumber,
                    $curlErrorMessage
                )
            );
        }

        return new HttpResponse(
            requestedUrl: $originalUrl,
            finalUrl: $url,
            statusCode: $statusCode,
            contentType: $contentType,
            body: $responseBody,
            headers: $responseHeaders,
            responseBytes: strlen($responseBody),
            durationMilliseconds: $durationMilliseconds,
            redirectCount: $redirectCount,
            remoteIp: $remoteIp
        );
    }

    /**
     * Extracts SEO and structural metadata from an HTML document.
     */
    public function parseMetadata(
        string $html,
        string $sourceUrl
    ): array {
        if (trim($html) === '') {
            throw new InvalidArgumentException(
                'The HTML payload is empty.'
            );
        }

        $previousLibxmlState =
            libxml_use_internal_errors(true);

        $dom = new DOMDocument(
            '1.0',
            'UTF-8'
        );

        $loaded = $dom->loadHTML(
            '<?xml encoding="UTF-8">' . $html,
            LIBXML_NONET |
            LIBXML_NOERROR |
            LIBXML_NOWARNING |
            LIBXML_COMPACT
        );

        libxml_clear_errors();
        libxml_use_internal_errors(
            $previousLibxmlState
        );

        if (!$loaded) {
            throw new RuntimeException(
                'DOMDocument could not parse the HTML payload.'
            );
        }

        $xpath = new DOMXPath($dom);

        $title = $this->firstValue(
            $xpath,
            '//title'
        );

        $description = $this->firstValue(
            $xpath,
            "//meta[
                translate(
                    @name,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'description'
            ]/@content"
        );

        $robots = $this->firstValue(
            $xpath,
            "//meta[
                translate(
                    @name,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'robots'
            ]/@content"
        );

        $canonical = $this->firstValue(
            $xpath,
            "//link[
                contains(
                    concat(
                        ' ',
                        normalize-space(
                            translate(
                                @rel,
                                'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                                'abcdefghijklmnopqrstuvwxyz'
                            )
                        ),
                        ' '
                    ),
                    ' canonical '
                )
            ]/@href"
        );

        $language = $this->firstValue(
            $xpath,
            '/html/@lang'
        );

        $charset = $this->firstValue(
            $xpath,
            '//meta[@charset]/@charset'
        );

        if ($charset === '') {
            $contentTypeValue = $this->firstValue(
                $xpath,
                "//meta[
                    translate(
                        @http-equiv,
                        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                        'abcdefghijklmnopqrstuvwxyz'
                    ) = 'content-type'
                ]/@content"
            );

            if (
                preg_match(
                    '/charset\s*=\s*([a-zA-Z0-9\-_]+)/i',
                    $contentTypeValue,
                    $matches
                )
            ) {
                $charset = $matches[1];
            }
        }

        $viewport = $this->firstValue(
            $xpath,
            "//meta[
                translate(
                    @name,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'viewport'
            ]/@content"
        );

        $openGraphTitle = $this->firstValue(
            $xpath,
            "//meta[
                translate(
                    @property,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'og:title'
            ]/@content"
        );

        $openGraphDescription = $this->firstValue(
            $xpath,
            "//meta[
                translate(
                    @property,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'og:description'
            ]/@content"
        );

        $h1Values = $this->nodeValues(
            $xpath,
            '//h1'
        );

        $h2Values = $this->nodeValues(
            $xpath,
            '//h2'
        );

        $linkMetrics = $this->analyseLinks(
            $xpath,
            $sourceUrl
        );

        $hreflangCount = $xpath->query(
            '//link[@hreflang]'
        )?->length ?? 0;

        $jsonLdCount = $xpath->query(
            "//script[
                translate(
                    @type,
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'abcdefghijklmnopqrstuvwxyz'
                ) = 'application/ld+json'
            ]"
        )?->length ?? 0;

        $wordCount = $this->calculateWordCount(
            $dom,
            $xpath
        );

        $robotsLowercase = strtolower(
            $robots
        );

        $isIndexable =
            !str_contains(
                $robotsLowercase,
                'noindex'
            );

        return [
            'page_title' => $title,
            'title_length' => mb_strlen($title),

            'meta_description' => $description,
            'meta_description_length' =>
                mb_strlen($description),

            'canonical_url' => $canonical,
            'robots_directive' => $robots,
            'indexable' => $isIndexable,

            'document_language' => $language,
            'document_charset' => $charset,
            'mobile_viewport' =>
                $viewport !== '',

            'open_graph' => [
                'title' => $openGraphTitle,
                'description' =>
                    $openGraphDescription
            ],

            'headings' => [
                'h1_count' => count($h1Values),
                'h1_values' => $h1Values,
                'h2_count' => count($h2Values),
                'h2_values' => array_slice(
                    $h2Values,
                    0,
                    10
                )
            ],

            'links' => $linkMetrics,

            'structured_data' => [
                'json_ld_blocks' => $jsonLdCount,
                'hreflang_entries' =>
                    $hreflangCount
            ],

            'content' => [
                'estimated_word_count' =>
                    $wordCount,
                'content_hash_sha256' =>
                    hash('sha256', $html)
            ],

            'status' => 'Data Normalized'
        ];
    }

    /**
     * Validates the target and blocks unsafe network destinations.
     */
    private function validateTargetUrl(
        string $url
    ): array {
        if (
            filter_var(
                $url,
                FILTER_VALIDATE_URL
            ) === false
        ) {
            throw new InvalidArgumentException(
                'The supplied target is not a valid URL.'
            );
        }

        $parts = parse_url($url);

        if ($parts === false) {
            throw new InvalidArgumentException(
                'Unable to parse the target URL.'
            );
        }

        $scheme = strtolower(
            $parts['scheme'] ?? ''
        );

        if (!in_array(
            $scheme,
            ['http', 'https'],
            true
        )) {
            throw new InvalidArgumentException(
                'Only HTTP and HTTPS targets are supported.'
            );
        }

        if (
            isset($parts['user']) ||
            isset($parts['pass'])
        ) {
            throw new InvalidArgumentException(
                'URLs containing embedded credentials are blocked.'
            );
        }

        $host = strtolower(
            trim(
                $parts['host'] ?? '',
                '[]'
            )
        );

        if ($host === '') {
            throw new InvalidArgumentException(
                'The target URL does not contain a hostname.'
            );
        }

        $port = (int) (
            $parts['port'] ??
            ($scheme === 'https' ? 443 : 80)
        );

        if (!in_array(
            $port,
            $this->config->allowedPorts,
            true
        )) {
            throw new InvalidArgumentException(
                sprintf(
                    'Port %d is not permitted.',
                    $port
                )
            );
        }

        $resolvedAddresses =
            $this->resolveHostAddresses($host);

        if ($resolvedAddresses === []) {
            throw new RuntimeException(
                'The target hostname could not be resolved.'
            );
        }

        foreach ($resolvedAddresses as $ipAddress) {
            if (
                !$this->config->allowPrivateNetworks &&
                !$this->isPublicIp($ipAddress)
            ) {
                throw new RuntimeException(
                    sprintf(
                        'Blocked private or reserved network destination: %s',
                        $ipAddress
                    )
                );
            }
        }

        return [
            'scheme' => $scheme,
            'host' => $host,
            'port' => $port,
            'ip' => $resolvedAddresses[0],
            'all_ips' => $resolvedAddresses
        ];
    }

    /**
     * Resolves both IPv4 and IPv6 addresses.
     */
    private function resolveHostAddresses(
        string $host
    ): array {
        if (
            filter_var(
                $host,
                FILTER_VALIDATE_IP
            ) !== false
        ) {
            return [$host];
        }

        $records = dns_get_record(
            $host,
            DNS_A | DNS_AAAA
        );

        if ($records === false) {
            return [];
        }

        $addresses = [];

        foreach ($records as $record) {
            if (isset($record['ip'])) {
                $addresses[] = $record['ip'];
            }

            if (isset($record['ipv6'])) {
                $addresses[] = $record['ipv6'];
            }
        }

        return array_values(
            array_unique($addresses)
        );
    }

    private function isPublicIp(
        string $ipAddress
    ): bool {
        return filter_var(
            $ipAddress,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE |
            FILTER_FLAG_NO_RES_RANGE
        ) !== false;
    }

    private function isHtmlContentType(
        string $contentType
    ): bool {
        $normalisedContentType =
            strtolower($contentType);

        return
            str_contains(
                $normalisedContentType,
                'text/html'
            ) ||
            str_contains(
                $normalisedContentType,
                'application/xhtml+xml'
            );
    }

    /**
     * Resolves relative Location headers safely.
     */
    private function resolveRedirectUrl(
        string $baseUrl,
        string $location
    ): string {
        $location = trim($location);

        if ($location === '') {
            throw new RuntimeException(
                'Redirect location is empty.'
            );
        }

        if (
            preg_match(
                '#^https?://#i',
                $location
            )
        ) {
            return $location;
        }

        $base = parse_url($baseUrl);

        if ($base === false) {
            throw new RuntimeException(
                'Unable to parse redirect base URL.'
            );
        }

        $scheme = $base['scheme'];
        $host = $base['host'];

        $port = isset($base['port'])
            ? ':' . $base['port']
            : '';

        $origin = sprintf(
            '%s://%s%s',
            $scheme,
            $host,
            $port
        );

        if (str_starts_with($location, '//')) {
            return $scheme . ':' . $location;
        }

        if (str_starts_with($location, '/')) {
            return $origin .
                $this->normalisePath($location);
        }

        if (str_starts_with($location, '?')) {
            return $origin .
                ($base['path'] ?? '/') .
                $location;
        }

        $basePath = $base['path'] ?? '/';

        $directory = str_ends_with(
            $basePath,
            '/'
        )
            ? $basePath
            : dirname($basePath) . '/';

        return $origin .
            $this->normalisePath(
                $directory . $location
            );
    }

    private function normalisePath(
        string $path
    ): string {
        $query = '';

        if (str_contains($path, '?')) {
            [$path, $queryPart] = explode(
                '?',
                $path,
                2
            );

            $query = '?' . $queryPart;
        }

        $segments = explode('/', $path);
        $normalisedSegments = [];

        foreach ($segments as $segment) {
            if (
                $segment === '' ||
                $segment === '.'
            ) {
                continue;
            }

            if ($segment === '..') {
                array_pop($normalisedSegments);

                continue;
            }

            $normalisedSegments[] = $segment;
        }

        return '/' .
            implode('/', $normalisedSegments) .
            $query;
    }

    private function firstValue(
        DOMXPath $xpath,
        string $query
    ): string {
        $nodes = $xpath->query($query);

        if (
            $nodes === false ||
            $nodes->length === 0
        ) {
            return '';
        }

        return trim(
            (string) $nodes->item(0)?->nodeValue
        );
    }

    private function nodeValues(
        DOMXPath $xpath,
        string $query
    ): array {
        $nodes = $xpath->query($query);

        if ($nodes === false) {
            return [];
        }

        $values = [];

        foreach ($nodes as $node) {
            $value = preg_replace(
                '/\s+/u',
                ' ',
                trim((string) $node->textContent)
            );

            if ($value !== '') {
                $values[] = $value;
            }
        }

        return $values;
    }

    private function analyseLinks(
        DOMXPath $xpath,
        string $sourceUrl
    ): array {
        $sourceHost = strtolower(
            parse_url(
                $sourceUrl,
                PHP_URL_HOST
            ) ?? ''
        );

        $internalLinks = 0;
        $externalLinks = 0;
        $nonHttpLinks = 0;

        $nodes = $xpath->query(
            '//a[@href]'
        );

        if ($nodes === false) {
            return [
                'total' => 0,
                'internal' => 0,
                'external' => 0,
                'non_http' => 0
            ];
        }

        foreach ($nodes as $node) {
            $href = trim(
                (string) $node->getAttribute('href')
            );

            if (
                $href === '' ||
                str_starts_with($href, '#')
            ) {
                continue;
            }

            if (
                preg_match(
                    '#^(mailto|tel|javascript|data):#i',
                    $href
                )
            ) {
                $nonHttpLinks++;

                continue;
            }

            $linkHost = strtolower(
                parse_url(
                    $href,
                    PHP_URL_HOST
                ) ?? ''
            );

            if (
                $linkHost === '' ||
                $linkHost === $sourceHost
            ) {
                $internalLinks++;
            } else {
                $externalLinks++;
            }
        }

        return [
            'total' =>
                $internalLinks +
                $externalLinks +
                $nonHttpLinks,

            'internal' => $internalLinks,
            'external' => $externalLinks,
            'non_http' => $nonHttpLinks
        ];
    }

    private function calculateWordCount(
        DOMDocument $dom,
        DOMXPath $xpath
    ): int {
        $removableNodes = $xpath->query(
            '//script | //style | //noscript | //svg'
        );

        if ($removableNodes !== false) {
            $nodesToRemove = [];

            foreach ($removableNodes as $node) {
                $nodesToRemove[] = $node;
            }

            foreach ($nodesToRemove as $node) {
                $node->parentNode?->removeChild($node);
            }
        }

        $body = $dom->getElementsByTagName(
            'body'
        )->item(0);

        if ($body === null) {
            return 0;
        }

        $text = preg_replace(
            '/\s+/u',
            ' ',
            trim($body->textContent)
        );

        if ($text === '') {
            return 0;
        }

        $words = preg_split(
            '/\s+/u',
            $text,
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        return is_array($words)
            ? count($words)
            : 0;
    }

    private function renderSummary(
        HttpResponse $response,
        array $metadata,
        float $totalDuration
    ): void {
        $this->terminal->section(
            '03',
            'crawl intelligence summary'
        );

        $this->terminal->metric(
            'HTTP status',
            $response->statusCode
        );

        $this->terminal->metric(
            'Final URL',
            $response->finalUrl
        );

        $this->terminal->metric(
            'Remote IP',
            $response->remoteIp
        );

        $this->terminal->metric(
            'Response size',
            $this->formatBytes(
                $response->responseBytes
            )
        );

        $this->terminal->metric(
            'Redirects followed',
            $response->redirectCount
        );

        $this->terminal->metric(
            'Page title',
            $metadata['page_title'] ?: 'Not detected'
        );

        $this->terminal->metric(
            'Meta description',
            $metadata['meta_description'] !== ''
                ? 'Detected'
                : 'Missing'
        );

        $this->terminal->metric(
            'Indexable',
            $metadata['indexable']
                ? 'Yes'
                : 'No'
        );

        $this->terminal->metric(
            'H1 elements',
            $metadata['headings']['h1_count']
        );

        $this->terminal->metric(
            'Internal links',
            $metadata['links']['internal']
        );

        $this->terminal->metric(
            'External links',
            $metadata['links']['external']
        );

        $this->terminal->metric(
            'Estimated words',
            $metadata['content']['estimated_word_count']
        );

        $this->terminal->metric(
            'Pipeline duration',
            $totalDuration . ' ms'
        );

        $this->terminal->footer();
    }

    private function formatBytes(
        int $bytes
    ): string {
        if ($bytes < 1024) {
            return $bytes . ' B';
        }

        if ($bytes < 1_048_576) {
            return round(
                $bytes / 1024,
                2
            ) . ' KB';
        }

        return round(
            $bytes / 1_048_576,
            2
        ) . ' MB';
    }
}


/* ==========================================================================
   06 // CLI RUNTIME
   ========================================================================== */

if (PHP_SAPI === 'cli') {
    $targetUrl = $argv[1] ?? 'https://example.com';

    $terminal = new TerminalUI();
    $logger = new CrawlerLogger(
        __DIR__ . '/logs/crawler.log'
    );

    $config = new CrawlerConfig(
        userAgent: 'JBona87-SEO-Crawler/2.0',
        connectTimeout: 8,
        requestTimeout: 20,
        maxRedirects: 5,
        maxResponseBytes: 5_000_000,
        allowPrivateNetworks: false,
        pinResolvedIp: true,
        allowedPorts: [80, 443]
    );

    try {
        $crawler = new WebDataCrawlerEngine(
            $config,
            $terminal,
            $logger
        );

        $result = $crawler->crawl(
            $targetUrl
        );

        $terminal->section(
            '04',
            'terminal JSON data stream'
        );

        echo json_encode(
            $result,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_THROW_ON_ERROR
        );

        echo PHP_EOL;

        exit(0);

    } catch (Throwable $error) {
        $terminal->error(
            'PIPELINE ERROR',
            $error->getMessage()
        );

        $logger->write(
            'error',
            'Crawler pipeline failed',
            [
                'url' => $targetUrl,
                'error' => $error->getMessage()
            ]
        );

        exit(1);
    }
}
```
