<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Enum for NewsAPI sort options
 */
enum SortBy: string
{
    case RELEVANCY = 'relevancy';
    case POPULARITY = 'popularity';
    case PUBLISHED_AT = 'publishedAt';

    /**
     * Get all sort values as an array
     * 
     * @return array<string> Array of sort values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Check if a sort option is valid
     * 
     * @param string $sortBy Sort option to validate
     * @return bool True if valid, false otherwise
     */
    public static function isValid(string $sortBy): bool
    {
        return self::tryFrom($sortBy) !== null;
    }
}
