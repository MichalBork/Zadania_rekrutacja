<?php

namespace App;

interface DataProviderInterface
{

    public function initFileWithData(string $fileName): void;

    public function getDataFromFile(string $fileName): string;

    public function setDataToFile(string $fileName, string $data): void;
}