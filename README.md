# Affiliate Content Proxy Suite

## Overview

This project provides a powerful, flexible solution for content fetching and image proxying, designed with affiliate marketing in mind. It allows you to fetch content from external sources and seamlessly replace resource URLs, ensuring they load through a custom proxy hosted on your domain. This enhances branding, security, and performance, making it an ideal tool for affiliate websites.

## Features

- **Dynamic Content Fetching**: Fetch content from any external URL using a simple PHP-based function.
- **Image Proxying**: Replace image URLs with a custom proxy to prevent hotlinking and reduce server load.
- **Lazy Load Support**: Automatically handles lazy-loaded images and other resources.
- **Resource Handling**: Rewrites URLs for CSS, JavaScript, and images hosted on the source server to load through the proxy.
- **SEO & Branding**: Keeps your affiliate links branded under your domain, improving SEO and user trust.
- **Caching Optimization**: Integrates well with Cloudflare and other caching strategies to minimize server overhead.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/xilverkamui/affiliate-content-proxy.git

2. **Upload files to your server:**
- fetch.php: Contains the main content fetching function.
- gambar.php: Image proxy script.
- index.php: main file.

3. **Set up your web server:**
- Ensure your server is configured to execute PHP scripts and supports URL rewriting (if needed).

## Usage
### Fetching Content
Use the fetchContent() function from fetch.php to retrieve and process content from an external URL.
include 'fetch.php';

```bash
$url = 'https://example.com/page';
$options = [
    'replace_words' => [
        ['replacing' => 'OldWord', 'replacement' => 'NewWord'],
    ],
];
```

### Proxying Images
Images hosted on the source server are automatically redirected to gambar.php, which acts as a proxy to prevent hotlinking and optimize loading times.

### Handling Lazy Loaded Images
The script automatically detects and processes lazy-loaded images using various attributes like data-src, data-lazy, and others.

### Configuration
You can customize the fetchContent() function to fit your needs by passing additional options, such as word replacements or additional headers.

### Caching with Cloudflare
To reduce server load, it's recommended to set up Cloudflare caching. This will cache the proxied content and reduce repeated server requests.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your improvements.

## License
This project is licensed under the MIT License. See the LICENSE file for details.

