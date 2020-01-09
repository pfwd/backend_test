<?php
declare(strict_types=1);

namespace App\Helper;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContainerParameterHelper
{
    private ParameterBagInterface $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getApplicationRootDir(): string
    {
        return $this->params->get('kernel.project_dir');
    }

    /**
     * @param string $parameterName
     * @return mixed
     */
    public function getParameter(string $parameterName)
    {
        return $this->params->get($parameterName);
    }
}