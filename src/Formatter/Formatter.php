<?php
declare(strict_types=1);

namespace App\Formatter;

use App\Entity\Quote;

class Formatter
{
    private FormatDecoratorInterface $formatter;

    public function __construct(FormatDecoratorInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @param string $raw
     * @return string
     */
    public function format(string $raw = ''): string
    {
        return $this->formatter->output($raw);
    }

    /**
     * @param array<Quote> $batch
     * @return array<string>
     */
    public function formatBatch(array $batch): array
    {
        return array_map([$this, 'format'], $batch);
    }
}