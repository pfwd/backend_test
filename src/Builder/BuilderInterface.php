<?php
declare(strict_types=1);

namespace App\Builder;

use App\Entity\Author;
use Doctrine\Common\Collections\ArrayCollection;

interface BuilderInterface
{
    /**
     * Validates the limit
     * @param int $limit
     */
    public function validateLimit(int $limit): void;

    /**
     * Gets the Author based on the supplied name
     * The Author is saved and retrieved from the cache
     *
     * @param string $name
     * @return Author
     */
    public function getCachedAuthorByName(string $name): Author;

    /**
     * Gets the quotes ArrayCollection based on the supplied Author and limit
     * Quotes are saved and retrieved from the cache
     *
     * @param Author $author
     * @param int|null $limit
     * @return ArrayCollection
     */
    public function getCachedQuotesByAuthor(Author $author, ?int $limit): ArrayCollection;

    /**
     * Generates the output as a string
     *
     * @param ArrayCollection $quotes
     * @return string
     */
    public function getOutput(ArrayCollection $quotes): string;
}