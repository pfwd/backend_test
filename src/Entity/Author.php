<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Polyfill\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name = '';

    /**
     * @ORM\Column(type="string", length=255)
     * @var ArrayCollection<Quote>
     */
    private ArrayCollection $quotes;

    public function __construct()
    {
        $this->quotes = new ArrayCollection();
        $this->id = Uuid::uuid_create();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param int|null $limit
     * @return ArrayCollection<Quote>
     */
    public function getQuotes(?int $limit = null): ArrayCollection
    {
        if($limit > 0){
            return new ArrayCollection($this->quotes->slice(0, (int) $limit));
        }
        return $this->quotes;
    }

    /**
     * @param array<Quote> $quotes
     * @return $this
     */
    public function setQuotes(array $quotes): self
    {
        $this->quotes->clear();

        foreach ($quotes as $quote) {
            if ($quote instanceof Quote) {
                $this->addQuote($quote);
            }
        }

        return $this;
    }

    /**
     * @param Quote $quote
     * @return $this
     */
    public function addQuote(Quote $quote): self
    {
        if (false === $this->quotes->contains($quote)) {
            $this->quotes->add($quote);
        }

        return $this;
    }
}
