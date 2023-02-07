### Установка
`composer require libgen/library-generator`


### Пример использования
```sh
require 'vendor/autoload.php';

use LibraryGenerator\Services\Sitemap;

// Список страниц сайта
$listPages = [
    [
        'loc' => 'https://site.ru',
        'lastmod' => '2020-12-14',
        'priority' => 0,
        'changefreq' => 'hourly'
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-10',
        'priority' => 0.5,
        'changefreq' => 'daily'
    ],
];
```

- **XML**
```sh
$sitemap = new Sitemap($listPages, 'xml', './storage/xml/sitemap.xml');

try {
  $sitemap->build();
} catch (Exception $ex) {
  echo $ex->getMessage();
}
```

- **JSON**
```sh
$sitemap = new Sitemap($listPages, 'json', './storage/json/sitemap.json');

try {
   $sitemap->build();
} catch (Exception $ex) {
   echo $ex->getMessage();
}
```

- **CSV**
```sh
$sitemap = new Sitemap($listPages, 'csv', './storage/csv/sitemap.csv');

try {
    $sitemap->build();
} catch (Exception $ex) {
    echo $ex->getMessage();
}
```

### License

MIT
