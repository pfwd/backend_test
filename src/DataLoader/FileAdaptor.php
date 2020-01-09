<?php
declare(strict_types=1);

namespace App\DataLoader;


use App\Entity\Author;
use App\Entity\Quote;
use Exception;

class FileAdaptor extends DataAdaptor implements AdaptorInterface
{
    private FileHandler $fileLoader;

    public function __construct(FileHandler $fileLoader)
    {
        $this->fileLoader = $fileLoader;
    }

    /**
     * @inheritDoc
     * @return array<Author>
     * @throws Exception
     */
    public function hydrate(): array
    {
        $fileContents = $this->fileLoader->read();
        $jsonData = json_decode($fileContents, true);

        $authors = [];

        foreach ($jsonData['quotes'] as $data) {
            $name = $this->clean($data['author']);
            if (false === in_array($name, $authors, false)) {
                $authors[$data['author']] = new Author();
                $authors[$data['author']]->setName($name);
            }
            $quote = new Quote($data['quote']);
            $authors[$data['author']]->addQuote($quote);
        }

        return array_values($authors);
    }

    public function clean(string $data): string
    {
        return trim(str_replace(['–','.'], '', $data));
    }
}
