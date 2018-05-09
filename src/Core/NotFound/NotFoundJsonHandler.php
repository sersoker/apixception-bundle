<?php
namespace Pccomponentes\Apixception\Core\NotFound;

use Pccomponentes\Apixception\Core\ApixceptionHandler;
use Symfony\Component\HttpFoundation\Response;

class NotFoundJsonHandler implements ApixceptionHandler
{
    public function match(\Exception $e): bool
    {
        return $e instanceof NotFoundException;
    }

    public function makeResponse(\Exception $e): Response
    {
        return new JsonResponse(
            [
                'message' => $e->getMessage(),
                'resource' => $e->resource(),
                'id' => $e->id()
            ],
            JsonResponse::HTTP_NOT_FOUND
        );
    }
}