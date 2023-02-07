<?php

namespace LibraryGenerator\Services\Generator;

use LibraryGenerator\Services\Files\FileMap;

class JsonGenerator extends Generator
{
    private FileMap $pages;

    private FileMap $fileMap;

    public function __construct(array $pages, FileMap $fileMap)
    {
        $this->pages    =$pages;
        $this->fileMap  =$fileMap;
    }

    private function generateJson(): bool|string
    {
        $listPages = [];

        foreach ($this->pages as $key => $page){
            $listPages[$key][self::LOC_TAG]         =htmlspecialchars($page['loc']);
            $listPages[$key][self::LASTMOD_TAG]     =$page['lastmod'];
            $listPages[$key][self::PRIORITY_TAG]    =$page['priority'];
            $listPages[$key][self::CHANGEFREG_TAG]  =$page['changefreq'];
        }

        return json_encode($listPages);
    }

    public function create()
    {
        $json = $this->generateJson();

        $this->fileMap->write($json);
    }
}