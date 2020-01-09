<?php
declare(strict_types=1);

namespace App\DataLoader;

interface HandlerInterface
{
    /**
     * Reads the contents of a resource
     * @return string
     */
    public function read(): string;
}