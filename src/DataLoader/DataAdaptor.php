<?php
declare(strict_types=1);

namespace App\DataLoader;

abstract class DataAdaptor
{
    /**
     * Clean up the data from resource
     * @param string $data
     * @return string
     */
    abstract public function clean(string $data): string;
}