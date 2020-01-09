<?php
declare(strict_types=1);

namespace App\Cache;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class AuthorCache
{
    /**
     * @var AuthorRepository
     */
    private AuthorRepository $authorRepository;

    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(AuthorRepository $authorRepository, CacheInterface $cache)
    {
        $this->authorRepository = $authorRepository;
        $this->cache = $cache;
    }

    /**
     * @param string $name
     * @return Author|null
     * @throws InvalidArgumentException
     */
    public function get(string $name): ?Author
    {
        $key = 'author_'.$name;
        $author = $this->cache->get(
            $key,
            function (ItemInterface $item) use ($name) {
                $item->expiresAfter(3600);

                return $this->authorRepository->findOneByName($name);
            }
        );

        return $author;
    }

}
