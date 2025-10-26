<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Enum for supported NewsAPI countries
 * 
 * Includes all countries supported by NewsAPI, including Arabic-speaking countries
 */
enum Country: string
{
    case UAE = 'ae';  // United Arab Emirates (Arabic)
    case ARGENTINA = 'ar';
    case AUSTRIA = 'at';
    case AUSTRALIA = 'au';
    case BELGIUM = 'be';
    case BULGARIA = 'bg';
    case BRAZIL = 'br';
    case CANADA = 'ca';
    case SWITZERLAND = 'ch';
    case CHINA = 'cn';
    case COLOMBIA = 'co';
    case CUBA = 'cu';
    case CZECH_REPUBLIC = 'cz';
    case GERMANY = 'de';
    case EGYPT = 'eg';  // Egypt (Arabic)
    case FRANCE = 'fr';
    case UNITED_KINGDOM = 'gb';
    case GREECE = 'gr';
    case HONG_KONG = 'hk';
    case HUNGARY = 'hu';
    case INDONESIA = 'id';
    case IRELAND = 'ie';
    case ISRAEL = 'il';
    case INDIA = 'in';
    case ITALY = 'it';
    case JAPAN = 'jp';
    case KOREA = 'kr';
    case LITHUANIA = 'lt';
    case LATVIA = 'lv';
    case MOROCCO = 'ma';  // Morocco (Arabic)
    case MEXICO = 'mx';
    case MALAYSIA = 'my';
    case NIGERIA = 'ng';
    case NETHERLANDS = 'nl';
    case NORWAY = 'no';
    case NEW_ZEALAND = 'nz';
    case PHILIPPINES = 'ph';
    case POLAND = 'pl';
    case PORTUGAL = 'pt';
    case ROMANIA = 'ro';
    case SERBIA = 'rs';
    case RUSSIA = 'ru';
    case SAUDI_ARABIA = 'sa';  // Saudi Arabia (Arabic)
    case SWEDEN = 'se';
    case SINGAPORE = 'sg';
    case SLOVENIA = 'si';
    case SLOVAKIA = 'sk';
    case THAILAND = 'th';
    case TURKEY = 'tr';
    case TAIWAN = 'tw';
    case UKRAINE = 'ua';
    case UNITED_STATES = 'us';
    case VENEZUELA = 've';
    case SOUTH_AFRICA = 'za';

    /**
     * Get all country codes as an array
     * 
     * @return array<string> Array of country codes
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Check if a country code is valid
     * 
     * @param string $code Country code to validate
     * @return bool True if valid, false otherwise
     */
    public static function isValid(string $code): bool
    {
        return self::tryFrom($code) !== null;
    }
}
