<?php

namespace LibraryGenerator\Services\Generator;

abstract class Generator
{
    const ROOT_TAG          = 'urlset';
    const ITEM_TAG          = 'url';
    const LOC_TAG           = 'loc';
    const LASTMOD_TAG       = 'lastmod';
    const PRIORITY_TAG      = 'priority';
    const CHANGEFREG_TAG    = 'changefreq';

    abstract public function create();
}