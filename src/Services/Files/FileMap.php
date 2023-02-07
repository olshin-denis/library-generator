<?php

namespace LibraryGenerator\Services\Files;

use LibraryGenerator\Services\Exceptions\FileMapException;

abstract class FileMap
{
    private \SplFileInfo $splFileInfo;

    private array $extensions = [
      'xml',
      'json',
      'csv'
    ];

    public function __construct($filePath)
    {
        $this->splFileInfo = new \SplFileInfo($filePath);
    }

    protected function getExtension(): string
    {
        return $this->splFileInfo->getExtension();
    }

    /**
     * @throws FileMapException
     */
    protected function getPath(): string
    {
        if(!in_array($this->getExtension(), $this->extensions)){
            throw new FileMapException(
                sprintf("Неизвестный формат. Допустимые значения: %s.", implode(',',$this->extensions))
            );
        }

        if(empty($this->splFileInfo->getPath())){
            throw new FileMapException("Пустое значение");
        }

        if(!file_exists($this->splFileInfo->getPath())){
            mkdir($this->splFileInfo->getPath());
        }

        return $this->splFileInfo->getPath();
    }

    /**
     * @throws FileMapException
     */
    protected function getPathFile(): string
    {
        if (empty($this->getExtension())){
            throw new FileMapException(sprintf("Не определён файл. Указано: %s", $this->splFileInfo->getFilename()));
        }

        return $this->splFileInfo->getFilename();
    }

    abstract public function write($text);
}