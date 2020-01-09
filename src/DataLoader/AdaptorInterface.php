<?php
declare(strict_types=1);

namespace App\DataLoader;

use App\Entity\Author;

interface AdaptorInterface
{
    /**
     * Hydrates an array of entities based on the data supplied
     * @return array<Author>
     */
    public function hydrate(): array;
}