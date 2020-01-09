<?php
declare(strict_types=1);

namespace App\Cache;

use App\Entity\Author;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class QuoteCache
{
    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param Author $author
     * @param int|null $limit
     * @return ArrayCollection
     * @throws InvalidArgumentException
     */
    public function get(Author $author, ?int $limit): ArrayCollection
    {
        $key = 'author_'.$author->getName().'_limit_'.$limit;
        $quotes = $this->cache->get(
            $key,
            static function (ItemInterface $item) use (
                $limit,
                $author
            ) {
                $item->expiresAfter(3600);

                return $author->getQuotes($limit);
            }
        );

        return $quotes;
    }

}
