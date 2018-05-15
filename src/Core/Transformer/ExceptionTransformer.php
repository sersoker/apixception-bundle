<?php
namespace Pccomponentes\Apixception\Core\Transformer;

abstract class ExceptionTransformer
{
    final public function __construct()
    {
    }

    public abstract function transform(\Throwable $exception): array;
}