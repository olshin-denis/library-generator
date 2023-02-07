<?php

namespace LibraryGenerator\Services\Exceptions;

class FileMapException extends HandlerSitemapException
{
    public function customMessage(): string
    {
        return "FileMap Exception: {$this->getMessage()}";
    }
}