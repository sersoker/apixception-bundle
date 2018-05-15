<?php
namespace Pccomponentes\Apixception\Core;

use Symfony\Component\HttpFoundation\Response;
use Pccomponentes\Apixception\Core\Transformer\ExceptionTransformer;

class ApixceptionSubscriber
{
    private $exception;
    private $httpCode;
    private $transformer;

    public function __construct(string $exception, int $httpCode, ExceptionTransformer $transformer)
    {
        $this->exception = $exception;
        $this->httpCode = $httpCode;
        $this->transformer = $transformer;
    }

    public function httpCode(): int
    {
        return $this->httpCode;
    }

    public function exception(): string
    {
        return $this->exception;
    }

    public function transform(\Throwable $exception): array
    {
        return $this->transformer->transform($exception);
    }
}