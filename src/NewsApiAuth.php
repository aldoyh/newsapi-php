<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Handles authentication for NewsAPI requests
 * 
 * @author Joseph Cobhams
 */
class NewsApiAuth
{
    /**
     * Create a new NewsApiAuth instance
     * 
     * @param string $apiKey The API key for NewsAPI authentication
     */
    public function __construct(
        private readonly string $apiKey
    ) {
    }

    /**
     * Get authentication headers for API requests
     * 
     * @return array<string, string> Array of authentication headers
     */
    public function getAuthHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Authorization' => "Bearer {$this->apiKey}",
        ];
    }
}