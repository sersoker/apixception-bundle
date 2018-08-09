<?php
namespace Pccomponentes\Apixception\Core\Transformer;

class NoSerializableTransformer extends ExceptionTransformer
{
    public function transform(\Throwable $exception): array
    {
        return [
            'exception' => \get_class($exception),
            'message' => $exception->getMessage()
        ];
    }
}