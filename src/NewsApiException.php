<?php

declare(strict_types=1);

namespace jcobhams\NewsApi;

/**
 * Exception class for NewsAPI errors
 */
class NewsApiException extends \Exception
{
    /**
     * Get a formatted error message
     * 
     * @return string Formatted error message with file and line information
     */
    public function errorMessage(): string
    {
        return "{$this->getMessage()} on line {$this->getLine()} in file {$this->getFile()}";
    }
}