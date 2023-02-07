<?php

namespace LibraryGenerator\Services\Generator;

use JetBrains\PhpStorm\ArrayShape;
use LibraryGenerator\Services\Files\FileMap;

class CsvGenerator extends Generator
{

    private FileMap $fileMap;
    private array $pages;

    public function __construct(array $pages, FileMap $fileMap)
    {
        $this->pages    = $pages;
        $this->fileMap  = $fileMap;
    }

    private function setTitle(): array
    {
        return[
            self::LOC_TAG,
            self::LASTMOD_TAG,
            self::PRIORITY_TAG,
            self::CHANGEFREG_TAG
        ];
    }

    private function setBody(): array
    {
        $body   = [];

        foreach ($this->pages as $page) {
            $body[] = $page;
        }

        return $body;
    }

    #[ArrayShape(['title' => "array", 'body' => "array"])] private function generateCsv(): array
    {
        return[
            'title' =>$this->setTitle(),
            'body'  =>$this->setBody()
        ];
    }

    public function create()
    {
        $csv = $this->generateCsv();

        $this->fileMap->write($csv);
    }
}