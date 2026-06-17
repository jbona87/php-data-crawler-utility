````markdown
<!-- ======================================================= -->
<!--              PHP DATA CRAWLER UTILITY                    -->
<!-- ======================================================= -->

<div align="center">

<img
  width="100%"
  src="https://capsule-render.vercel.app/api?type=waving&height=245&color=0:030712,45:111827,100:00F5D4&text=PHP%20DATA%20CRAWLER%20CORE&fontColor=FFFFFF&fontSize=40&fontAlignY=35&desc=SECURE%20HTTP%20EXTRACTION%20%7C%20DOM%20PARSING%20%7C%20SEO%20INTELLIGENCE&descAlignY=57&descSize=14&animation=fadeIn"
/>

<img
  src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=600&size=18&duration=2700&pause=900&color=00F5D4&center=true&vCenter=true&repeat=true&width=850&height=55&lines=INITIALIZING+SECURE+CRAWLER+PIPELINE...;VALIDATING+TARGET+NETWORK+BOUNDARIES...;PARSING+HTML+DOCUMENT+STRUCTURES...;COMPILING+TECHNICAL+SEO+INTELLIGENCE..."
  alt="PHP crawler terminal animation"
/>

<br>

<img src="https://img.shields.io/badge/CRAWLER%20CORE-ONLINE-00F5D4?style=for-the-badge&labelColor=030712" />
<img src="https://img.shields.io/badge/PHP-8.0%2B-777BB4?style=for-the-badge&logo=php&logoColor=white&labelColor=030712" />
<img src="https://img.shields.io/badge/SSL%20VERIFICATION-ENABLED-22C55E?style=for-the-badge&labelColor=030712" />
<img src="https://img.shields.io/badge/INTERFACE-CLI-A855F7?style=for-the-badge&logo=gnubash&logoColor=white&labelColor=030712" />

</div>

---

## `01 // SYSTEM OVERVIEW`

```yaml
system:
  name: "Enterprise PHP Data Crawler Core"
  runtime: "PHP 8.0+"
  interface: "Command-Line Interface"
  architecture: "Object-Oriented Extraction Pipeline"
  status: "Operational"

mission:
  input: "Validated HTTP or HTTPS target URL"

  process:
    - Validate target
    - Resolve network destination
    - Execute secure HTTP request
    - Inspect response metadata
    - Parse HTML document
    - Extract technical SEO signals
    - Compile structured JSON

  output:
    - HTTP response intelligence
    - Page metadata
    - Heading analysis
    - Link metrics
    - Indexability signals
    - Structured crawler logs
```

> A secure, object-oriented PHP crawler designed to retrieve public HTML documents, inspect HTTP responses and transform page structures into clean technical SEO intelligence.

---

## `02 // CORE CRAWLER MODULES`

<table>
<tr>
<td width="50%" valign="top">

### ⚡ Secure HTTP Extraction

Uses cURL to retrieve remote HTML documents through a controlled request pipeline.

**Core operations**

- HTTP and HTTPS requests
- SSL certificate verification
- Configurable connection timeouts
- Response-size protection
- Redirect inspection
- Content-type validation

</td>
<td width="50%" valign="top">

### ◈ Network Validation

Validates destinations before sending requests and checks redirect targets individually.

**Core operations**

- URL-format validation
- DNS resolution
- HTTP and HTTPS restrictions
- Private-network protection
- Port restrictions
- Redirect destination validation

</td>
</tr>

<tr>
<td width="50%" valign="top">

### ⬡ DOM Intelligence Engine

Transforms raw HTML into structured document intelligence using native PHP DOM components.

**Core operations**

- Page-title extraction
- Meta-description extraction
- Canonical detection
- Robots-directive inspection
- Heading analysis
- Open Graph extraction

</td>
<td width="50%" valign="top">

### ⌁ Technical SEO Analysis

Produces structured metrics that can support auditing and search-visibility workflows.

**Core operations**

- Indexability detection
- Internal and external link counts
- H1 and H2 extraction
- JSON-LD detection
- Hreflang detection
- Estimated word count

</td>
</tr>
</table>

---

## `03 // EXTRACTION PIPELINE`

```mermaid
flowchart LR
    A["01 // TARGET URL"] --> B["02 // URL VALIDATION"]
    B --> C["03 // DNS RESOLUTION"]
    C --> D["04 // SECURE REQUEST"]
    D --> E["05 // HTTP INSPECTION"]
    E --> F["06 // HTML VALIDATION"]
    F --> G["07 // DOM PARSING"]
    G --> H["08 // SEO ANALYSIS"]
    H --> I["09 // JSON OUTPUT"]

    classDef input fill:#030712,stroke:#A855F7,color:#FFFFFF,stroke-width:2px;
    classDef process fill:#030712,stroke:#00F5D4,color:#FFFFFF,stroke-width:2px;
    classDef output fill:#030712,stroke:#22C55E,color:#FFFFFF,stroke-width:2px;

    class A input;
    class B,C,D,E,F,G,H process;
    class I output;
```

<div align="center">

`VALIDATE` → `CONNECT` → `FETCH` → `PARSE` → `ANALYSE` → `EXPORT`

</div>

---

## `04 // COMPONENT TOOLCHAIN`

### Runtime

<p>
  <img src="https://img.shields.io/badge/PHP%208-030712?style=for-the-badge&logo=php&logoColor=00F5D4" />
  <img src="https://img.shields.io/badge/CLI%20Runtime-030712?style=for-the-badge&logo=gnubash&logoColor=A855F7" />
  <img src="https://img.shields.io/badge/OOP%20Architecture-030712?style=for-the-badge&logo=abstract&logoColor=22C55E" />
</p>

### Native components

<p>
  <img src="https://img.shields.io/badge/cURL-030712?style=for-the-badge&logo=curl&logoColor=00F5D4" />
  <img src="https://img.shields.io/badge/DOMDocument-030712?style=for-the-badge&logo=html5&logoColor=A855F7" />
  <img src="https://img.shields.io/badge/DOMXPath-030712?style=for-the-badge&logo=xml&logoColor=22C55E" />
  <img src="https://img.shields.io/badge/libxml-030712?style=for-the-badge&logo=xml&logoColor=FBBF24" />
  <img src="https://img.shields.io/badge/JSON-030712?style=for-the-badge&logo=json&logoColor=00D9FF" />
</p>

### System capabilities

<p>
  <img src="https://img.shields.io/badge/HTTP%20INSPECTION-030712?style=for-the-badge&logo=googlechrome&logoColor=00F5D4" />
  <img src="https://img.shields.io/badge/SEO%20METADATA-030712?style=for-the-badge&logo=google&logoColor=A855F7" />
  <img src="https://img.shields.io/badge/LINK%20ANALYSIS-030712?style=for-the-badge&logo=chainlink&logoColor=22C55E" />
  <img src="https://img.shields.io/badge/STRUCTURED%20OUTPUT-030712?style=for-the-badge&logo=json&logoColor=00D9FF" />
</p>

---

## `05 // INTELLIGENCE OUTPUT`

The crawler compiles request information and extracted page signals into a structured JSON payload:

```json
{
  "system": {
    "engine": "Enterprise PHP Data Crawler Core",
    "version": "2.0.0",
    "processed_at": "2026-06-17T15:40:00+00:00",
    "pipeline_status": "Completed"
  },
  "request": {
    "requested_url": "https://example.com",
    "final_url": "https://example.com",
    "http_status": 200,
    "content_type": "text/html",
    "response_bytes": 1256,
    "redirects_followed": 0,
    "request_duration_ms": 142.38
  },
  "seo_intelligence": {
    "page_title": "Example Domain",
    "title_length": 14,
    "meta_description": "This domain is for use in illustrative examples in documents.",
    "canonical_url": "",
    "robots_directive": "",
    "indexable": true,
    "headings": {
      "h1_count": 1,
      "h1_values": [
        "Example Domain"
      ]
    },
    "links": {
      "total": 1,
      "internal": 0,
      "external": 1,
      "non_http": 0
    },
    "status": "Data Normalized"
  }
}
```

---

## `06 // TERMINAL SIMULATION`

```console
╔══════════════════════════════════════════════════════════════════════════════╗
║  ENTERPRISE PHP DATA CRAWLER CORE                                           ║
║  VERSION 2.0.0  //  SECURE EXTRACTION  //  DOM INTELLIGENCE                ║
╚══════════════════════════════════════════════════════════════════════════════╝

 01 // SECURE EXTRACTION PIPELINE
────────────────────────────────────────────────────────────────────────────────
◆ [TARGET] https://example.com
◆ [CONNECT] example.com → 93.184.216.34
✓ [HTTP] Server responded with HTTP 200
✓ [STREAM] 1.23 KB received

 02 // DOM PARSING MATRIX
────────────────────────────────────────────────────────────────────────────────
✓ [DOM] HTML document parsed successfully
✓ [SEO] Metadata boundaries normalised

 03 // CRAWL INTELLIGENCE SUMMARY
────────────────────────────────────────────────────────────────────────────────
  ▸ HTTP status                  200
  ▸ Final URL                    https://example.com
  ▸ Page title                   Example Domain
  ▸ Meta description             Detected
  ▸ Indexable                    Yes
  ▸ H1 elements                  1
  ▸ Internal links               0
  ▸ External links               1
  ▸ Estimated words              28
  ▸ Pipeline duration            148.42 ms

  RAW HTML IN  //  STRUCTURED WEB INTELLIGENCE OUT
```

---

## `07 // REPOSITORY STRUCTURE`

```text
php-data-crawler-core/
│
├── WebDataCrawlerEngine.php
├── README.md
├── composer.json
│
├── src/
│   ├── CrawlerConfig.php
│   ├── WebDataCrawlerEngine.php
│   ├── HttpResponse.php
│   ├── TerminalUI.php
│   └── CrawlerLogger.php
│
├── output/
│   └── crawl-result.json
│
├── logs/
│   └── crawler.log
│
└── tests/
    ├── UrlValidationTest.php
    └── MetadataParserTest.php
```

> A single-file implementation can keep all components inside `WebDataCrawlerEngine.php`. The modular structure is intended for larger projects.

---

## `08 // REQUIREMENTS`

Before running the crawler, confirm that the following components are available:

```text
PHP 8.0 or newer
PHP cURL extension
PHP DOM extension
PHP libxml extension
Command-line access
```

Check the active PHP version:

```bash
php --version
```

Check required extensions:

```bash
php -m
```

The module list should include:

```text
curl
dom
libxml
```

---

## `09 // QUICK START`

### Clone the repository

```bash
git clone https://github.com/jbona87/php-data-crawler-core.git
cd php-data-crawler-core
```

### Execute the crawler

```bash
php WebDataCrawlerEngine.php https://example.com
```

### Crawl another public page

```bash
php WebDataCrawlerEngine.php https://www.example.org/page
```

### Save the JSON output

```bash
php WebDataCrawlerEngine.php https://example.com > crawl-result.json
```

> Replace the example repository URL and filename when necessary.

---

## `10 // CONFIGURATION MATRIX`

The crawler behaviour can be controlled through `CrawlerConfig`:

```php
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
```

| Setting | Purpose |
|---|---|
| `userAgent` | Identifies the crawler during HTTP requests |
| `connectTimeout` | Maximum time allowed to establish a connection |
| `requestTimeout` | Maximum duration of the complete request |
| `maxRedirects` | Maximum number of validated redirects |
| `maxResponseBytes` | Prevents unexpectedly large downloads |
| `allowPrivateNetworks` | Controls access to private network destinations |
| `pinResolvedIp` | Pins the validated DNS result during the request |
| `allowedPorts` | Restricts crawler connections to approved ports |

---

## `11 // EXTRACTED SEO SIGNALS`

| Category | Signals |
|---|---|
| HTTP | Status code, content type, response size and response duration |
| Metadata | Title, description, canonical and robots directive |
| Indexability | `index`, `noindex` and robots interpretation |
| Headings | H1 and H2 counts and extracted values |
| Social | Open Graph title and description |
| Links | Internal, external and non-HTTP link totals |
| International | Document language and hreflang entries |
| Structured data | JSON-LD block count |
| Content | Estimated word count and HTML content hash |

---

## `12 // SECURITY CONTROLS`

The engine is designed to maintain secure request boundaries.

```text
[✓] SSL peer verification
[✓] SSL hostname verification
[✓] HTTP and HTTPS protocol restrictions
[✓] Private and reserved IP blocking
[✓] Redirect destination validation
[✓] Response-size limitation
[✓] Connection and request timeouts
[✓] Embedded credential rejection
[✓] Approved-port enforcement
```

SSL validation should remain enabled:

```php
CURLOPT_SSL_VERIFYPEER => true,
CURLOPT_SSL_VERIFYHOST => 2
```

Disabling SSL verification can expose the crawler to intercepted or untrusted responses and is not recommended for production use.

---

## `13 // RESPONSIBLE CRAWLING`

Use this utility only against pages you are permitted to access.

Before crawling a website:

- Review its terms of service.
- Respect applicable robots directives.
- Use a transparent user-agent identifier.
- Avoid excessive request frequency.
- Do not attempt to bypass authentication or access controls.
- Cache responses where appropriate.
- Follow relevant privacy and data-protection requirements.

The configurable user agent exists for identification and compatibility—not for impersonating users or defeating website protections.

---

## `14 // ENGINEERING PRINCIPLES`

<table>
<tr>
<td align="center" width="25%">

### `01`

**SECURE**

Validate each destination before transmitting a request.

</td>
<td align="center" width="25%">

### `02`

**TRACEABLE**

Record execution events, failures and response metrics.

</td>
<td align="center" width="25%">

### `03`

**STRUCTURED**

Convert raw HTML into predictable intelligence objects.

</td>
<td align="center" width="25%">

### `04`

**EXTENSIBLE**

Support additional metadata, audit rules and output formats.

</td>
</tr>
</table>

---

## `15 // DEVELOPMENT ROADMAP`

```text
[✓] Secure cURL extraction
[✓] Redirect destination validation
[✓] DOM and XPath metadata parsing
[✓] HTTP response inspection
[✓] Technical SEO signal extraction
[✓] Structured JSON output
[✓] File-based pipeline logging

[ ] robots.txt parser
[ ] XML sitemap discovery
[ ] Batch URL crawling
[ ] Crawl-depth controls
[ ] Rate limiting
[ ] Retry and backoff logic
[ ] CSV report generation
[ ] Broken-link detection
[ ] Duplicate metadata analysis
[ ] Core Web Vitals API integration
```

---

## `16 // SYSTEM STATUS`

<div align="center">

<table>
<tr>
<td align="center">

### `NETWORK NODE`

Validated public target

`CONNECTED`

</td>
<td align="center">

### `CRAWLER CORE`

Secure PHP runtime

`OPERATIONAL`

</td>
<td align="center">

### `INTELLIGENCE NODE`

Structured SEO output

`READY`

</td>
</tr>
</table>

<br>

> ### `PUBLIC HTML IN // STRUCTURED WEB INTELLIGENCE OUT`

<br>

<img src="https://img.shields.io/badge/HTTP%20PIPELINE-ACTIVE-00F5D4?style=for-the-badge&labelColor=030712" />
<img src="https://img.shields.io/badge/DOM%20PARSER-READY-A855F7?style=for-the-badge&labelColor=030712" />
<img src="https://img.shields.io/badge/SEO%20INTELLIGENCE-ONLINE-22C55E?style=for-the-badge&labelColor=030712" />

<br><br>

<sub>
JBONA87-PHP // SECURE EXTRACTION CORE // DOM INTELLIGENCE ACTIVE
</sub>

</div>

<img
  width="100%"
  src="https://capsule-render.vercel.app/api?type=waving&height=130&section=footer&color=0:00F5D4,45:111827,100:030712"
/>
````
