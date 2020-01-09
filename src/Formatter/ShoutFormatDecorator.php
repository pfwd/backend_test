<?php
declare(strict_types=1);

namespace App\Formatter;

class ShoutFormatDecorator implements FormatDecoratorInterface
{
    /**
     * @param string $raw
     * @return string
     */
    public function output(string $raw = ''): string
    {
        return strtoupper(trim($raw, '.!')) . '!';
    }
}