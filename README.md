# NewsAPI-PHP

A modern PHP 8.1+ client for the [News API](https://newsapi.org/docs/get-started) with full Arabic language support.

## Features

- ✨ **Modern PHP 8.1+**: Uses latest PHP features including enums, readonly properties, constructor property promotion, and strict types
- 🌍 **Full Arabic Support**: Complete support for Arabic language (العربية) and Arabic-speaking countries
- 🔒 **Type-Safe**: Comprehensive type hints and strict type checking
- 📦 **PSR-4 Autoloading**: Fully compliant with modern PHP standards
- 🧪 **Well Tested**: Comprehensive test suite with PHPUnit 9

## Requirements

- PHP 8.1 or higher
- Guzzle HTTP client 7.8+

## Installation

Available for installation on packagist using composer:

```bash
composer require jcobhams/newsapi
```

## Usage

### Basic Setup

After installation and requiring `vendor/autoload.php` in your project:

Get your API key from [here](https://newsapi.org/register)

```php
<?php

use jcobhams\NewsApi\NewsApi;

$newsapi = new NewsApi('your-api-key-here');
```

### Get Top Headlines

```php
// Get top headlines for a country
$headlines = $newsapi->getTopHeadLines(country: 'us');

// Get top headlines in Arabic from Saudi Arabia
$arabicHeadlines = $newsapi->getTopHeadLines(country: 'sa');

// Get top headlines for a specific category
$techNews = $newsapi->getTopHeadLines(country: 'us', category: 'technology');

// Search top headlines with Arabic keywords
$results = $newsapi->getTopHeadLines(q: 'الرياضة', country: 'eg');

// Get headlines from specific sources
$bbcNews = $newsapi->getTopHeadLines(sources: 'bbc-news,cnn');
```

#### Parameters

- `q` (string|null): Keywords or phrase to search for (supports Arabic: مثال للبحث)
- `sources` (string|null): Comma-separated source identifiers (cannot be mixed with country or category)
- `country` (string|null): 2-letter ISO 3166-1 country code (e.g., 'us', 'sa', 'eg', 'ae')
- `category` (string|null): Category (business, entertainment, general, health, science, sports, technology)
- `pageSize` (int|null): Number of results per page (1-100, default 20)
- `page` (int|null): Page number for pagination

### Get Everything

Search through millions of articles with advanced filtering:

```php
// Search for articles in English
$results = $newsapi->getEverything(q: 'artificial intelligence', language: 'en');

// Search for Arabic articles
$arabicResults = $newsapi->getEverything(q: 'التكنولوجيا', language: 'ar');

// Search with date range
$recentNews = $newsapi->getEverything(
    q: 'climate change',
    from: '2024-01-01',
    to: '2024-12-31',
    language: 'en',
    sortBy: 'publishedAt'
);

// Search specific domains
$techBlogs = $newsapi->getEverything(
    q: 'programming',
    domains: 'techcrunch.com,arstechnica.com',
    language: 'en'
);
```

#### Parameters

- `q` (string|null): Keywords or phrase to search for (supports Arabic)
- `sources` (string|null): Comma-separated source identifiers
- `domains` (string|null): Comma-separated domains (e.g., 'bbc.co.uk,techcrunch.com')
- `excludeDomains` (string|null): Comma-separated domains to exclude
- `from` (string|null): Oldest article date (ISO 8601 format: YYYY-MM-DD or YYYY-MM-DDTHH:MM:SS)
- `to` (string|null): Newest article date (ISO 8601 format: YYYY-MM-DD or YYYY-MM-DDTHH:MM:SS)
- `language` (string): Language code (default: 'en', use 'ar' for Arabic)
- `sortBy` (string|null): Sort order (relevancy, popularity, publishedAt)
- `pageSize` (int|null): Number of results per page (1-100, default 20)
- `page` (int|null): Page number for pagination

### Get Sources

Get available news sources with optional filtering:

```php
// Get all sources
$sources = $newsapi->getSources();

// Get Arabic language sources
$arabicSources = $newsapi->getSources(language: 'ar');

// Get sources from Saudi Arabia
$saSources = $newsapi->getSources(country: 'sa');

// Get technology sources
$techSources = $newsapi->getSources(category: 'technology');

// Combined filters
$arabicTechSources = $newsapi->getSources(category: 'technology', language: 'ar');
```

### Helper Methods

```php
// Get list of supported countries (includes Arabic countries: sa, eg, ae, ma)
$countries = $newsapi->getCountries();

// Get list of supported languages (includes ar for Arabic)
$languages = $newsapi->getLanguages();

// Get list of supported categories
$categories = $newsapi->getCategories();

// Get list of supported sort options
$sortOptions = $newsapi->getSortBy();
```

## Arabic Language Support (دعم اللغة العربية)

This library provides comprehensive support for Arabic language content:

### Supported Arabic-Speaking Countries

- 🇸🇦 Saudi Arabia (`sa`)
- 🇪🇬 Egypt (`eg`)
- 🇦🇪 United Arab Emirates (`ae`)
- 🇲🇦 Morocco (`ma`)

### Using Arabic Language

```php
use jcobhams\NewsApi\NewsApi;

$newsapi = new NewsApi('your-api-key');

// Get top headlines from Saudi Arabia
$headlines = $newsapi->getTopHeadLines(country: 'sa');

// Search for Arabic content
$results = $newsapi->getEverything(
    q: 'السعودية',
    language: 'ar',
    sortBy: 'publishedAt'
);

// Get Arabic news sources
$sources = $newsapi->getSources(language: 'ar');
```

### Supported Languages

The library supports all NewsAPI languages with special focus on:
- `ar` - Arabic (العربية) ✓
- `en` - English
- `de` - German (Deutsch)
- `es` - Spanish (Español)
- `fr` - French (Français)
- `he` - Hebrew (עברית)
- And more...

## Modern PHP Features Used

This library leverages the latest PHP 8.1+ features for better code quality and developer experience:

- **Enums**: Type-safe country, language, category, and sort options
- **Readonly Properties**: Immutable configuration for better security
- **Constructor Property Promotion**: Cleaner, more concise code
- **Strict Types**: Enhanced type safety throughout the codebase
- **Named Arguments**: Flexible and readable method calls
- **Return Type Declarations**: Clear API contracts
- **Match Expressions**: Simplified conditional logic

## Error Handling

The library throws `NewsApiException` for various error conditions:

```php
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

try {
    $newsapi = new NewsApi('your-api-key');
    $results = $newsapi->getTopHeadLines(country: 'us');
} catch (NewsApiException $e) {
    echo "Error: " . $e->getMessage();
    // Or get detailed error information
    echo $e->errorMessage();
}
```

## Testing

Run the test suite:

```bash
./vendor/bin/phpunit
```

Run tests with detailed output:

```bash
./vendor/bin/phpunit --testdox
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License.

## Author

**Joseph Cobhams**
- Email: jcobhams@gmail.com

## Acknowledgments

- [NewsAPI](https://newsapi.org/) for providing the excellent news API service
- The PHP community for continuous improvements to the language

