<?php

namespace App\Repository;

use App\DataLoader\DataLoaderInterface;
use App\Entity\Author;


class AuthorRepository
{
    private DataLoaderInterface $dataLoader;

    /**
     * AuthorRepository constructor.
     * @param DataLoaderInterface $dataLoader
     */
    public function __construct(DataLoaderInterface $dataLoader)
    {
        $this->dataLoader = $dataLoader;
    }

    /**
     * @param string $name
     * @return Author|null
     */
    public function findOneByName(string $name): ?Author
    {
        $name = str_replace('-', ' ', $name);
        $data = $this->dataLoader->load();
        $found = null;
        foreach ($data as $author) {
            if (($author instanceof Author) && strtolower($name) === strtolower($author->getName())) {
                $found = $author;
                break;
            }
        }

        return $found;
    }

}
