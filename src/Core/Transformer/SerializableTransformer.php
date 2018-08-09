<?php
namespace Pccomponentes\Apixception\Core\Transformer;

class SerializableTransformer extends ExceptionTransformer
{
    public function transform(\Throwable $exception): array
    {
        return [
            'message' => $exception->getMessage(),
            'data' => $exception->serialice()
        ];
    }
}