## Indoregion

composer require azishapidin/indoregion

php artisan indoregion:publish

composer dump-autoload

php artisan db:seed --class=IndoRegionSeeder

# Excel

composer require maatwebsite/excel

php artisan make:export ArtikelExport --model=Artikel
