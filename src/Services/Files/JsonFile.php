<?php

namespace LibraryGenerator\Services\Files;

use LibraryGenerator\Services\Exceptions\FileMapException;

class JsonFile extends FileMap
{
    /**
     * @throws FileMapException
     */
    public function write($text)
    {
        if (!is_dir($this->getPath())){
            throw new FileMapException("Не удалось записать в файл. Не определена директория.");
        }
        file_put_contents($this->getPathFile(), $text);
    }
}