<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Helper class for NewsAPI operations
 * 
 * Provides URL generation and validation utilities
 * 
 * @author Joseph Cobhams
 */
final class Helpers
{
    private const BASE_URL = 'https://newsapi.org/v2';

    /**
     * Get the top headlines endpoint URL
     * 
     * @param string|null $params Optional query parameters
     * @return string Full URL for top headlines endpoint
     */
    final public static function topHeadlinesUrl(?string $params = null): string
    {
        return $params 
            ? self::BASE_URL . "/top-headlines?{$params}"
            : self::BASE_URL . '/top-headlines';
    }

    /**
     * Get the everything endpoint URL
     * 
     * @param string|null $params Optional query parameters
     * @return string Full URL for everything endpoint
     */
    final public static function everythingUrl(?string $params = null): string
    {
        return $params 
            ? self::BASE_URL . "/everything?{$params}"
            : self::BASE_URL . '/everything';
    }

    /**
     * Get the sources endpoint URL
     * 
     * @param string|null $params Optional query parameters
     * @return string Full URL for sources endpoint
     */
    final public static function sourcesUrl(?string $params = null): string
    {
        return $params 
            ? self::BASE_URL . "/sources?{$params}"
            : self::BASE_URL . '/sources';
    }

    /**
     * Check if a country code is valid
     * 
     * @param string $country Country code to validate
     * @return bool True if valid, false otherwise
     */
    final public static function isCountryValid(string $country): bool
    {
        return Country::isValid($country);
    }

    /**
     * Check if a language code is valid
     * 
     * @param string $language Language code to validate
     * @return bool True if valid, false otherwise
     */
    final public static function isLanguageValid(string $language): bool
    {
        return Language::isValid($language);
    }

    /**
     * Check if a category is valid
     * 
     * @param string $category Category to validate
     * @return bool True if valid, false otherwise
     */
    final public static function isCategoryValid(string $category): bool
    {
        return Category::isValid($category);
    }

    /**
     * Check if a sort option is valid
     * 
     * @param string $sortBy Sort option to validate
     * @return bool True if valid, false otherwise
     */
    final public static function isSortByValid(string $sortBy): bool
    {
        return SortBy::isValid($sortBy);
    }

    /**
     * Get values for a specific type
     * 
     * @param string $key Type key (countries, languages, categories, sort)
     * @return array<string> Array of values
     */
    final public static function __get__(string $key): array
    {
        return match($key) {
            'countries' => Country::values(),
            'languages' => Language::values(),
            'categories' => Category::values(),
            'sort' => SortBy::values(),
            default => [],
        };
    }
}
