<?php
declare(strict_types=1);

namespace App\DataLoader;

use App\Entity\Author;
use App\Helper\ContainerParameterHelper;
use Exception;

class DataLoader implements DataLoaderInterface
{
    /**
     * @var ContainerParameterHelper
     */
    private ContainerParameterHelper $parameterBag;

    public function __construct(ContainerParameterHelper $parameterHelper)
    {
        $this->parameterBag = $parameterHelper;
    }

    /**
     * @return array<Author>
     * @throws Exception
     */
    public function load(): array
    {
        /**
         * Using the Adaptor pattern
         * Other adaptors and handlers could be used to deal with other data sources.
         * This could be coming from a Guzzle request, CSV file or somewhere else
         */
        $fileHandler = new FileHandler();
        $filePath = $this->parameterBag->getApplicationRootDir().'/quotes.json';
        $fileHandler->setPath($filePath);
        $fileAdaptor = new FileAdaptor($fileHandler);

        return $fileAdaptor->hydrate();
    }

}
