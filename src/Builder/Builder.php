<?php
declare(strict_types=1);

namespace App\Builder;

use App\Cache\AuthorCache;
use App\Cache\QuoteCache;
use App\Entity\Author;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Cache\InvalidArgumentException;
use RuntimeException;

abstract class Builder implements BuilderInterface
{
    protected const LIMIT_MAX = 10;
    private AuthorCache $authorCache;
    private QuoteCache $quoteCache;

    /**
     * OutputBuilder constructor.
     * @param AuthorCache $authorCache
     * @param QuoteCache $quoteCache
     */
    public function __construct(AuthorCache $authorCache, QuoteCache $quoteCache)
    {
        $this->authorCache = $authorCache;
        $this->quoteCache = $quoteCache;
    }


    /**
     * @param int $limit
     * @throws RuntimeException
     */
    public function validateLimit(int $limit): void
    {
        if ($limit > self::LIMIT_MAX) {
            throw new RuntimeException('Limit must be less than or equal to 10', 400);
        }
    }

    /**
     * @param string $name
     * @return Author
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    public function getCachedAuthorByName(string $name): Author
    {
        $author = $this->authorCache->get($name);

        if (false === $author instanceof Author) {
            throw new RuntimeException('Cannot find author', 404);
        }

        return $author;
    }

    /**
     * @param Author $author
     * @param int|null $limit
     * @return ArrayCollection
     * @throws InvalidArgumentException
     */
    public function getCachedQuotesByAuthor(Author $author, ?int $limit): ArrayCollection
    {
        $quotes = $this->quoteCache->get($author, $limit);

        if ($quotes->isEmpty()) {
            throw new RuntimeException('Cannot find quotes for author', 404);
        }

        return $quotes;
    }

    abstract public function getOutput(ArrayCollection $quotes):string;

}