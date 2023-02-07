<?php

namespace LibraryGenerator\Services\Generator;

use LibraryGenerator\Services\Exceptions\FileMapException;
use LibraryGenerator\Services\Exceptions\GeneratorNotDefinedFormatException;
use LibraryGenerator\Services\Files\CsvFile;
use LibraryGenerator\Services\Files\JsonFile;
use LibraryGenerator\Services\Files\XmlFile;

class GeneratorFactory
{
    const TYPE_XML  = 'xml';
    const TYPE_JSON = 'json';
    const TYPE_CSV  = 'csv';

    /**
     * @throws GeneratorNotDefinedFormatException
     */
    public function getGenerator(array $pages, $format, $path): JsonGenerator|XmlGenerator
    {

        return match ($format) {
            self::TYPE_XML => new XmlGenerator($pages, (new XmlFile($path))),
            self::TYPE_JSON => new JsonGenerator($pages, (new JsonFile($path))),
            self::TYPE_CSV => new CsvGenerator($pages, (new CsvFile($path))),
            default => throw new GeneratorNotDefinedFormatException('Формат не определён' . $format),
        };
    }
}