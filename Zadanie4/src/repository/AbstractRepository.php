<?php

namespace App\repository;

use App\DataProvider;
use App\DataProviderInterface;

class AbstractRepository
{

    protected DataProviderInterface $dataProvider;

    public function __construct()
    {
        $this->dataProvider = new DataProvider();
    }

    public function save(string $fileName, array $data): void
    {

        $this->dataProvider->setDataToFile($fileName, $this->dataToJson($data));
    }


    public function get(string $fileName): array
    {
        $data = $this->dataProvider->getDataFromFile($fileName);

        return $this->dataFromJson($data);
    }

    private function dataToJson(array $data): string
    {

        return json_encode($data);
    }

    private function dataFromJson(string $data): array
    {
        return json_decode($data, true);

    }
}