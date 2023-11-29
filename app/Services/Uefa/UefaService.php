<?php
declare(strict_types=1);

namespace App\Services\Uefa;

use PHPHtmlParser\Dom;

/**
 * Class UefaService
 * @package App\Services\Uefa
 */
class UefaService
{
    /**
     * @var array $data
     */
    private array $data = [];

    public function __construct()
    {
        $this->prepareData();
    }

    /**
     * @return void
     */
    private function prepareData(): void
    {
        $data = [];

        $dom = new Dom();
        $dom->loadFromFile(storage_path('app/uefa.html'));
        $dom->loadFromUrl('https://news.sportbox.ru/Vidy_sporta/Futbol/stats/uefatable');
        $uefaTable = $dom->find('.uefa-table')[0];
        $countryList = $uefaTable->find('.country');
        foreach ($countryList as $countryItem) {
            $divList = $countryItem->find('div');
            $data[] = [
                'name' => trim($divList[1]->text),
                'rating' => trim($divList[8]->text),
            ];
        }

        usort($data, function ($a, $b) {
            return $a['rating'] > $b['rating'] ? -1 : 1;
        });

        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
