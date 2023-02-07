<?php

namespace LibraryGenerator\Services\Exceptions;

class GeneratorNotDefinedFormatException extends HandlerSitemapException
{
    public function customMessage(): string
    {
        return "Generator exception: {$this->getMessage()}";
    }
}