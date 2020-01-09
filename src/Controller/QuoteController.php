<?php

namespace App\Controller;

use App\Builder\JSONShoutBuilder;
use Exception;
use Psr\Cache\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuoteController extends AbstractController
{
    private JSONShoutBuilder $builder;

    public function __construct(JSONShoutBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @Route(
     *     "/shout/{name}",
     *     name="shout",
     *     methods={"GET","HEAD"},
     *     requirements={"name"="^([a-z-]+)$"}
     * )
     * @param Request $request
     * @return Response
     *
     */
    public function shout(Request $request): Response
    {
        $name = $request->get('name');
        $limit = (int)$request->query->get('limit');

        try {
            /**
             * Using the Builder design pattern.
             * A ConsoleShoutBuilder could be used if it implemented BuilderInterface
             * A Director class could be used to handle the building of the output
             */
            $this->builder->validateLimit($limit);
            $author = $this->builder->getCachedAuthorByName($name);
            $quotes = $this->builder->getCachedQuotesByAuthor($author, $limit);
            $json = $this->builder->getOutput($quotes);

        } catch (Exception $exception) {
            /**
             * @todo log the exception
             */
            $message = ($exception->getCode() === 500) ? 'Something has gone wrong, please try again' :  $exception->getMessage();
            return $this->json(['error' => $message], $exception->getCode());
        } catch (InvalidArgumentException $e) {
            // Cache error
            /**
             * @todo log the exception
             */
            return $this->json(['error' => 'Something has gone wrong, please try again'], 500);
        }

        return new Response($json, 200, [
            'Content-Type' => 'application/json;charset=utf-8'
        ]);
    }
}
