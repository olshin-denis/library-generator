<?php

namespace LibraryGenerator\Services\Exceptions;

class HandlerSitemapException extends \Exception
{
    public function customMessage(): string
    {
        return "HandlerSitemap Exception: {$this->getMessage()}";
    }
}