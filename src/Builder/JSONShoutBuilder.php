<?php
declare(strict_types=1);

namespace App\Builder;

use App\Formatter\Formatter;
use App\Formatter\ShoutFormatDecorator;
use Doctrine\Common\Collections\ArrayCollection;
use RuntimeException;

class JSONShoutBuilder extends Builder
{
    /**
     * @param ArrayCollection $quotes
     * @return string
     * @throws RuntimeException
     */
    public function getOutput(ArrayCollection $quotes): string
    {
        /**
         * If there were more than one formatter this could be refactored into a factory.
         * @example $formatted = $factory->make($quotes, ShoutFormatDecorator::class)
         */
        // Using the Decorator design pattern
        $decorator = new ShoutFormatDecorator();
        $formatter = new Formatter($decorator);
        $output = $formatter->formatBatch($quotes->getValues());

        $json = json_encode($output, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_IGNORE);
        if (false === $json) {
            throw new RuntimeException('Cannot create JSON response');
        }

        return $json;
    }

}