<?php

namespace LibraryGenerator\Services\Exceptions;

class SitemapInvalidArgumentException extends HandlerSitemapException
{
    public function customMessage() : string
    {
        return "SiteMapInvalidArgument Exception: {$this->getMessage()}";
    }
}