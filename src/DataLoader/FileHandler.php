<?php
declare(strict_types=1);

namespace App\DataLoader;

use Exception;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileHandler implements HandlerInterface
{
    /**
     * @var string
     */
    private string $path;

    /**
     * @inheritDoc
     * @return string
     * @throws Exception
     */
    public function read(): string
    {
        if (false === file_exists($this->getPath())) {
            throw new FileNotFoundException('File '.$this->getPath().' does not exist');
        }

        if (false === is_readable($this->getPath())) {
            throw new FileException('File '.$this->getPath().' is not readable');
        }

        $data = file_get_contents($this->getPath());

        if(FALSE === $data) {
            throw new Exception('Cannot get contents from '. $this->getPath());
        }

        return $data;


    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

}
