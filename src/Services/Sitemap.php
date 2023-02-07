<?php

namespace LibraryGenerator\Services;

use LibraryGenerator\Services\Exceptions\HandlerSitemapException;
use LibraryGenerator\Services\Generator\Generator;
use LibraryGenerator\Services\Generator\GeneratorFactory;
use LibraryGenerator\Services\Validates\ArgumentsValidate;

class Sitemap
{
    private array $pages;

    private $format;

    private $path;

    public function __construct(array $pages, $format, $path)
    {
        $this->pages    =$pages;
        $this->format   =$format;
        $this->path     =$path;
    }

    public function build()
    {
        try {
            ArgumentsValidate::validate($this->pages);

            /** @var Generator $generator */

            $generator = (new GeneratorFactory())->getGenerator($this->pages, $this->format, $this->path);

            $generator->create();
        } catch (HandlerSitemapException $e){
            echo $e->customMessage();
        }
    }
}