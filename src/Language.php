<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Enum for supported NewsAPI languages
 * 
 * Includes Arabic (ar) with full support
 */
enum Language: string
{
    case ARABIC = 'ar';      // Arabic - مدعوم بالكامل
    case ENGLISH = 'en';
    case CHINESE = 'cn';
    case GERMAN = 'de';
    case SPANISH = 'es';
    case FRENCH = 'fr';
    case HEBREW = 'he';
    case ITALIAN = 'it';
    case DUTCH = 'nl';
    case NORWEGIAN = 'no';
    case PORTUGUESE = 'pt';
    case RUSSIAN = 'ru';
    case SWEDISH = 'sv';
    case URDU = 'ud';

    /**
     * Get all language codes as an array
     * 
     * @return array<string> Array of language codes
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Check if a language code is valid
     * 
     * @param string $code Language code to validate
     * @return bool True if valid, false otherwise
     */
    public static function isValid(string $code): bool
    {
        return self::tryFrom($code) !== null;
    }

    /**
     * Get the display name for a language
     * 
     * @return string Display name of the language
     */
    public function displayName(): string
    {
        return match($this) {
            self::ARABIC => 'Arabic (العربية)',
            self::ENGLISH => 'English',
            self::CHINESE => 'Chinese (中文)',
            self::GERMAN => 'German (Deutsch)',
            self::SPANISH => 'Spanish (Español)',
            self::FRENCH => 'French (Français)',
            self::HEBREW => 'Hebrew (עברית)',
            self::ITALIAN => 'Italian (Italiano)',
            self::DUTCH => 'Dutch (Nederlands)',
            self::NORWEGIAN => 'Norwegian (Norsk)',
            self::PORTUGUESE => 'Portuguese (Português)',
            self::RUSSIAN => 'Russian (Русский)',
            self::SWEDISH => 'Swedish (Svenska)',
            self::URDU => 'Urdu (اردو)',
        };
    }
}
