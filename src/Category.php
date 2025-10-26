<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Enum for NewsAPI article categories
 */
enum Category: string
{
    case BUSINESS = 'business';
    case ENTERTAINMENT = 'entertainment';
    case GENERAL = 'general';
    case HEALTH = 'health';
    case SCIENCE = 'science';
    case SPORTS = 'sports';
    case TECHNOLOGY = 'technology';

    /**
     * Get all category values as an array
     * 
     * @return array<string> Array of category values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Check if a category is valid
     * 
     * @param string $category Category to validate
     * @return bool True if valid, false otherwise
     */
    public static function isValid(string $category): bool
    {
        return self::tryFrom($category) !== null;
    }
}
