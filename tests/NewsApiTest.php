<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use jcobhams\NewsApi\NewsApi;
use jcobhams\NewsApi\NewsApiException;

/**
 * Test suite for NewsAPI PHP client
 * 
 * Includes tests for Arabic language support
 */
class NewsApiTest extends TestCase
{
    private NewsApi $newsapi;

    protected function setUp(): void
    {
        parent::setUp();
        $this->newsapi = new NewsApi('some-api-key');
    }

    // TOP HEADLINES ENDPOINT TESTS

    public function testGetTopHeadLinesThrowsNewsApiExceptionIfSourcesUsedWithCountry(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getTopHeadLines(
            q: null,
            sources: 'bbc',
            country: 'ng'
        );
    }

    public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidCountryUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getTopHeadLines(
            q: null,
            sources: null,
            country: 'kl'
        );
    }

    public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidCategoryUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getTopHeadLines(
            q: null,
            sources: null,
            country: 'ng',
            category: 'data'
        );
    }

    public function testGetTopHeadLinesThrowsNewsApiExceptionIfInvalidPageSizeUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getTopHeadLines(
            q: null,
            sources: null,
            country: 'ng',
            category: 'business',
            pageSize: 1000
        );
    }

    public function testGetTopHeadLines(): void
    {
        // Write Mocks API Call and response test
        $this->assertTrue(true);
    }

    // ARABIC LANGUAGE SUPPORT TESTS

    public function testGetTopHeadlinesSupportsArabicCountries(): void
    {
        // Test that Arabic-speaking countries are accepted
        $arabicCountries = ['sa', 'eg', 'ae', 'ma']; // Saudi Arabia, Egypt, UAE, Morocco
        
        foreach ($arabicCountries as $country) {
            try {
                // This should not throw exception for country validation
                // (It will fail on API call due to test API key, but that's expected)
                $this->newsapi->getTopHeadLines(country: $country);
                $this->fail("Expected NewsApiException for invalid API key");
            } catch (NewsApiException $e) {
                // Should fail on API call, not on country validation
                $this->assertStringNotContainsString('Invalid Country', $e->getMessage());
            }
        }
        
        $this->assertTrue(true);
    }

    // EVERYTHING ENDPOINT TESTS

    public function testGetEverythingThrowsNewsApiExceptionIfInvalidLanguageUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getEverything(
            q: null,
            sources: 'mtv-news',
            language: 'ek'
        );
    }

    public function testGetEverythingThrowsNewsApiExceptionIfInvalidSortingUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getEverything(
            q: null,
            language: 'en',
            sortBy: 'quality'
        );
    }

    public function testGetEverythingThrowsNewsApiExceptionIfInvalidPageSizeUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getEverything(
            q: null,
            language: 'en',
            pageSize: 1000
        );
    }

    public function testGetEverythingSupportsArabicLanguage(): void
    {
        try {
            // Arabic language should be accepted
            $this->newsapi->getEverything(language: 'ar');
            $this->fail("Expected NewsApiException for invalid API key");
        } catch (NewsApiException $e) {
            // Should fail on API call, not on language validation
            $this->assertStringNotContainsString('Invalid Language', $e->getMessage());
        }
        
        $this->assertTrue(true);
    }

    public function testGetEverything(): void
    {
        $this->assertTrue(true);
    }

    // SOURCES ENDPOINT TESTS

    public function testGetSourcesThrowsNewsApiExceptionIfInvalidCategoryUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getSources(category: 'data');
    }

    public function testGetSourcesThrowsNewsApiExceptionIfInvalidLanguageUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getSources(language: 'ek');
    }

    public function testGetSourcesThrowsNewsApiExceptionIfInvalidCountryUsed(): void
    {
        $this->expectException(NewsApiException::class);
        $this->newsapi->getSources(country: 'kl');
    }

    public function testGetSourcesSupportsArabicLanguage(): void
    {
        try {
            // Arabic language should be accepted for sources
            $this->newsapi->getSources(language: 'ar');
            $this->fail("Expected NewsApiException for invalid API key");
        } catch (NewsApiException $e) {
            // Should fail on API call, not on language validation
            $this->assertStringNotContainsString('Invalid Language', $e->getMessage());
        }
        
        $this->assertTrue(true);
    }

    public function testGetSources(): void
    {
        // Write Mocks API Call and response test
        $this->assertTrue(true);
    }

    // HELPER METHODS TESTS

    public function testGetLanguagesIncludesArabic(): void
    {
        $languages = $this->newsapi->getLanguages();
        $this->assertContains('ar', $languages, 'Arabic language code should be included');
    }

    public function testGetCountriesIncludesArabicCountries(): void
    {
        $countries = $this->newsapi->getCountries();
        
        // Check for major Arabic-speaking countries
        $this->assertContains('sa', $countries, 'Saudi Arabia should be included');
        $this->assertContains('eg', $countries, 'Egypt should be included');
        $this->assertContains('ae', $countries, 'UAE should be included');
        $this->assertContains('ma', $countries, 'Morocco should be included');
    }

    public function testGetCategories(): void
    {
        $categories = $this->newsapi->getCategories();
        $this->assertIsArray($categories);
        $this->assertNotEmpty($categories);
    }

    public function testGetSortBy(): void
    {
        $sortOptions = $this->newsapi->getSortBy();
        $this->assertIsArray($sortOptions);
        $this->assertNotEmpty($sortOptions);
    }
}
