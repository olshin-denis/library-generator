<?php

namespace LibraryGenerator\Services\Validates;

use LibraryGenerator\Services\Exceptions\SitemapInvalidArgumentException;
use LibraryGenerator\Services\Generator\Generator;

class ArgumentsValidate
{
    private static int $maxLocLen = 2048;

    private static array $changefreqs = [
        'always',
        'hourly',
        'daily',
        'weekly',
        'monthly',
        'yearly',
        'never',
    ];

    private static array $priorities = [
        0.0,
        0.1,
        0.2,
        0.3,
        0.4,
        0.5,
        0.6,
        0.7,
        0.8,
        0.9,
        1.0,
    ];

    /**
     * @throws SitemapInvalidArgumentException
     */
    private static function emptyRequired(array $arguments): void
    {
        if (!key_exists(Generator::LOC_TAG, $arguments) || empty($arguments[Generator::LOC_TAG])){
            throw new SitemapInvalidArgumentException(sprintf("Не указан или пустой тег: %s", Generator::LOC_TAG));
        }
    }

    /**
     * @throws SitemapInvalidArgumentException
     */
    private static function validateLengthLoc(array $arguments): void
    {
        $tag = Generator::LOC_TAG;

        if (key_exists($tag, $arguments)&&!(1<=mb_strlen($arguments[$tag])&&mb_strlen($arguments[$tag])<=self::$maxLocLen))
        {
            throw new SitemapInvalidArgumentException("Невалидная длина URL-адреса страницы. Длина этого значения не должна превышать 2048 символов");
        }
    }

    /**
     * @throws SitemapInvalidArgumentException
     */
    private static function validatePriorities(array $arguments): void
    {
        $tag = Generator::PRIORITY_TAG;

        if(key_exists($tag, $arguments)&&!in_array($arguments[$tag], self::$priorities)){
            throw new SitemapInvalidArgumentException(
              sprintf("Невалидовая приоритетность. Допустимый диапазон значений - от 0,0 до 1,0. Указано: %.1f", floatval($arguments[$tag]))
            );
        }
    }

    /**
     * @throws SitemapInvalidArgumentException
     */
    private static function validateChangefreqs(array $arguments): void
    {
        $tag = Generator::CHANGEFREG_TAG;

        if (key_exists($tag, $arguments)&&!in_array($arguments[$tag], self::$changefreqs)){
            throw new SitemapInvalidArgumentException(
                sprintf("Невалидная вероятная частота изменения. Допустимые значения: %s. Указано: %s", implode(',',self::$changefreqs), $arguments[$tag]));
        }
    }

    /**
     * @throws SitemapInvalidArgumentException
     */
    private static function validateDate(array $arguments): void
    {
        $tag = Generator::LASTMOD_TAG;

        if (key_exists($tag, $arguments)){
            $d = \DateTime::createFromFormat('Y-m-d', $arguments[$tag]);

            if (!($d&&$d->format('Y-m-d') === $arguments[$tag])){
                throw new SitemapInvalidArgumentException(sprintf("Невалидный формат даты последнего изменения файла. Допустимый формат Y-m-d. Указано: %s", $arguments[$tag]));
            }
        }
    }

    /**
     * @throws SitemapInvalidArgumentException
     */
    public static function validate(array $listArguments): void
    {
        foreach ($listArguments as $arguments){
            self::emptyRequired($arguments);
            self::validateLengthLoc($arguments);
            self::validatePriorities($arguments);
            self::validateChangefreqs($arguments);
            self::validateDate($arguments);
        }
    }
}