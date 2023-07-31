<?php

namespace App;

class DataProvider implements DataProviderInterface
{

    const DIR_NAME = 'model';

    public function initFileWithData(string $fileName): void
    {
        $this->dirDontExist();


        if (!file_exists(self::DIR_NAME . '/' . $fileName)) {
            $file = fopen(self::DIR_NAME . '/' . $fileName, 'w');
            fclose($file);
        }


    }

    /**
     * @return void
     */
    private function dirDontExist(): void
    {
        if (!file_exists(self::DIR_NAME)) {
            mkdir(self::DIR_NAME, 0777, true);
        }
    }


    public function getDataFromFile(string $fileName): string
    {
        $this->initFileWithData($fileName);
        $file = fopen(self::DIR_NAME . '/' . $fileName, 'r');
        $data = '';
        while (!feof($file)) {
            $data .= fgets($file);
        }
        fclose($file);
        return $data;
    }


    public function setDataToFile(string $fileName, string $data): void
    {
        $this->initFileWithData($fileName);
        $file = fopen(self::DIR_NAME . '/' . $fileName, 'w');
        fwrite($file, $data);
        fclose($file);

    }

}