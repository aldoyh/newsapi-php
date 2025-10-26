<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Modern PHP client for NewsAPI with full Arabic support
 * 
 * Features:
 * - Full support for Arabic language (ar) and Arabic-speaking countries
 * - Modern PHP 8.1+ features (constructor property promotion, enums, readonly properties)
 * - Type-safe API with strict types
 * - Comprehensive error handling
 * 
 * @author Joseph Cobhams
 */
class NewsApi
{
    private readonly array $requestHeaders;
    private readonly Client $client;

    /**
     * Create a new NewsApi client instance
     * 
     * @param string $apiKey Your NewsAPI API key from https://newsapi.org
     */
    public function __construct(string $apiKey)
    {
        $auth = new NewsApiAuth($apiKey);
        $this->requestHeaders = $auth->getAuthHeaders();
        $this->client = new Client(['timeout' => 30]);
    }

    /**
     * Get top headlines with optional filters
     * 
     * Supports Arabic sources and search queries in Arabic.
     * 
     * @param string|null $q Keywords or phrase to search for (supports Arabic: مثال للبحث)
     * @param string|null $sources Comma-separated source identifiers
     * @param string|null $country 2-letter ISO 3166-1 country code (e.g., 'sa', 'eg', 'ae' for Arabic countries)
     * @param string|null $category News category
     * @param int|null $pageSize Number of results per page (1-100)
     * @param int|null $page Page number for pagination
     * 
     * @return object JSON response object
     * @throws NewsApiException If validation fails or API request fails
     */
    public function getTopHeadLines(
        ?string $q = null,
        ?string $sources = null,
        ?string $country = null,
        ?string $category = null,
        ?int $pageSize = null,
        ?int $page = null
    ): object {
        $payload = [];

        // Add search keyword if provided (supports Arabic)
        if ($q !== null) {
            $payload['q'] = $q;
        }

        // Ensure sources is not mixed with country or category
        if ($sources !== null && ($country !== null || $category !== null)) {
            throw new NewsApiException(
                "You Cannot Use Sources with Country or Category at the same time."
            );
        }

        // Add sources if provided
        if ($sources !== null) {
            $payload['sources'] = $sources;
        }

        // Add country if provided (includes Arabic countries: sa, eg, ae, ma)
        if ($country !== null) {
            if (Helpers::isCountryValid($country)) {
                $payload['country'] = $country;
            } else {
                throw new NewsApiException("Invalid Country Identifier Provided");
            }
        }

        // Add category if provided
        if ($category !== null) {
            if (Helpers::isCategoryValid($category)) {
                $payload['category'] = $category;
            } else {
                throw new NewsApiException("Invalid Category Identifier Provided");
            }
        }

        // Validate and add page size
        if ($pageSize !== null) {
            if ($pageSize >= 1 && $pageSize <= 100) {
                $payload['pageSize'] = $pageSize;
            } else {
                throw new NewsApiException("Invalid Page_size Value Provided");
            }
        }

        // Add page number
        if ($page !== null) {
            $payload['page'] = $page;
        }

        return $this->makeRequest(Helpers::topHeadlinesUrl(), $payload);
    }

    /**
     * Search through millions of articles with optional filters
     * 
     * Fully supports Arabic language searches and content.
     * 
     * @param string|null $q Keywords or phrase to search for (supports Arabic)
     * @param string|null $sources Comma-separated source identifiers
     * @param string|null $domains Comma-separated domains to search
     * @param string|null $excludeDomains Comma-separated domains to exclude
     * @param string|null $from Oldest article date (ISO 8601 format: YYYY-MM-DD)
     * @param string|null $to Newest article date (ISO 8601 format: YYYY-MM-DD)
     * @param string $language Language code (default: 'en', use 'ar' for Arabic)
     * @param string|null $sortBy Sort order: relevancy, popularity, or publishedAt
     * @param int|null $pageSize Number of results per page (1-100)
     * @param int|null $page Page number for pagination
     * 
     * @return object JSON response object
     * @throws NewsApiException If validation fails or API request fails
     */
    public function getEverything(
        ?string $q = null,
        ?string $sources = null,
        ?string $domains = null,
        ?string $excludeDomains = null,
        ?string $from = null,
        ?string $to = null,
        string $language = 'en',
        ?string $sortBy = null,
        ?int $pageSize = null,
        ?int $page = null
    ): object {
        $payload = [];

        // Add search keyword if provided (supports Arabic)
        if ($q !== null) {
            $payload['q'] = $q;
        }

        // Add sources if provided
        if ($sources !== null) {
            $payload['sources'] = $sources;
        }

        // Add domains if provided
        if ($domains !== null) {
            $payload['domains'] = $domains;
        }

        // Add exclude domains if provided
        if ($excludeDomains !== null) {
            $payload['excludeDomains'] = $excludeDomains;
        }

        // Validate and add from date
        if ($from !== null) {
            if (strlen($from) < 10) {
                throw new NewsApiException('from argument must be YYYY-MM-DD format');
            }
            $payload['from'] = $from;
        }

        // Validate and add to date
        if ($to !== null) {
            if (strlen($to) < 10) {
                throw new NewsApiException('to argument must be YYYY-MM-DD format');
            }
            $payload['to'] = $to;
        }

        // Add language if provided (including Arabic support)
        if (Helpers::isLanguageValid($language)) {
            $payload['language'] = $language;
        } else {
            throw new NewsApiException("Invalid Language Identifier Provided");
        }

        // Add sort option if provided
        if ($sortBy !== null) {
            if (Helpers::isSortByValid($sortBy)) {
                $payload['sortBy'] = $sortBy;
            } else {
                throw new NewsApiException("Invalid SortBy Identifier Provided");
            }
        }

        // Validate and add page size
        if ($pageSize !== null) {
            if ($pageSize >= 1 && $pageSize <= 100) {
                $payload['pageSize'] = $pageSize;
            } else {
                throw new NewsApiException("Invalid Page_size Value Provided");
            }
        }

        // Add page number
        if ($page !== null) {
            $payload['page'] = $page;
        }

        return $this->makeRequest(Helpers::everythingUrl(), $payload);
    }

    /**
     * Get available news sources with optional filters
     * 
     * @param string|null $category Filter by category
     * @param string|null $language Filter by language (use 'ar' for Arabic sources)
     * @param string|null $country Filter by country (e.g., 'sa', 'eg', 'ae' for Arabic countries)
     * 
     * @return object JSON response object
     * @throws NewsApiException If validation fails or API request fails
     */
    public function getSources(
        ?string $category = null,
        ?string $language = null,
        ?string $country = null
    ): object {
        $payload = [];

        // Add category if provided
        if ($category !== null) {
            if (Helpers::isCategoryValid($category)) {
                $payload['category'] = $category;
            } else {
                throw new NewsApiException("Invalid Category Identifier Provided");
            }
        }

        // Add language if provided (including Arabic)
        if ($language !== null) {
            if (Helpers::isLanguageValid($language)) {
                $payload['language'] = $language;
            } else {
                throw new NewsApiException("Invalid Language Identifier Provided");
            }
        }

        // Add country if provided (including Arabic countries)
        if ($country !== null) {
            if (Helpers::isCountryValid($country)) {
                $payload['country'] = $country;
            } else {
                throw new NewsApiException("Invalid Country Identifier Provided");
            }
        }

        return $this->makeRequest(Helpers::sourcesUrl(), $payload);
    }

    /**
     * Get list of supported countries
     * 
     * @return array<string> Array of country codes
     */
    public function getCountries(): array
    {
        return Helpers::__get__('countries');
    }

    /**
     * Get list of supported languages (includes Arabic)
     * 
     * @return array<string> Array of language codes
     */
    public function getLanguages(): array
    {
        return Helpers::__get__('languages');
    }

    /**
     * Get list of supported categories
     * 
     * @return array<string> Array of category names
     */
    public function getCategories(): array
    {
        return Helpers::__get__('categories');
    }

    /**
     * Get list of supported sort options
     * 
     * @return array<string> Array of sort options
     */
    public function getSortBy(): array
    {
        return Helpers::__get__('sort');
    }

    /**
     * Make an HTTP request to the NewsAPI
     * 
     * @param string $url API endpoint URL
     * @param array<string, mixed> $payload Query parameters
     * 
     * @return object JSON response object
     * @throws NewsApiException If the request fails
     */
    private function makeRequest(string $url, array $payload): object
    {
        try {
            $response = $this->client->request('GET', $url, [
                'headers' => $this->requestHeaders,
                'query' => $payload,
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody()->__toString());
            }

            $responseBody = json_decode($response->getBody()->__toString());
            throw new NewsApiException($responseBody->message ?? 'Unknown error occurred');
        } catch (GuzzleException $e) {
            throw new NewsApiException($e->getMessage());
        }
    }
}
