<?php
declare(strict_types=1);

namespace App\Formatter;

interface FormatDecoratorInterface
{
    /**
     * Formats the output
     * @param string $raw
     * @return string
     */
    public function output(string $raw): string;
}