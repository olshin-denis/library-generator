<?php

namespace LibraryGenerator\Services\Files;

use LibraryGenerator\Services\Exceptions\FileMapException;

class CsvFile extends FileMap
{
    /**
     * @throws FileMapException
     */
    public function write($text)
    {
        if (!is_dir($this->getPath())){
            throw new FileMapException("Не удалось записать файл. Не определена директория");
        }
        if (($file = fopen($this->getPathFile(), 'w')) === false){
            throw new FileMapException("Не удалось открыть файл для записи.");
        }

        fputcsv($file, $text['title'], ';');

        foreach ($text['body'] as $item){
            fputcsv($file, $item, ';');
        }

        fclose($file);
    }
}