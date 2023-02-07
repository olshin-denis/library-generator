<?php

namespace LibraryGenerator\Services\Generator;

use LibraryGenerator\Services\Files\FileMap;

class XmlGenerator extends Generator
{
    private array $pages;

    private FileMap $fileMap;

    public function __construct(array $pages, FileMap $fileMap)
    {
        $this->pages    =$pages;
        $this->fileMap  =$fileMap;
    }

    private function generateXml(): bool|string
    {
        ob_start();

        $writer = new \XMLWriter();
        $writer->openUri('php://output');

        $writer->setIndent(true);
        $writer->startDocument('1.0', 'UTF-8');

        $writer->startElement(self::ROOT_TAG);
        $writer->writeAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");
        $writer->writeAttribute('xsi:schemaLocation', "http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($this->pages as $page){
            $writer->startElement(self::ITEM_TAG);

            $writer->writeElement(self::LOC_TAG, htmlspecialchars($page['loc']));
            $writer->writeElement(self::LASTMOD_TAG, $page['lastmod']);
            $writer->writeElement(self::PRIORITY_TAG, $page['priority']);
            $writer->writeElement(self::CHANGEFREG_TAG, $page['changefreq']);

            $writer->endElement();
        }
        $writer->endElement();
        $writer->endDocument();

        return ob_get_clean();
    }

    public function create()
    {
        $xml = $this->generateXml();

        $this->fileMap->write($xml);
    }
}