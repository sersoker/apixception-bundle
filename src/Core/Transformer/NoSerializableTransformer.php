<?php
declare(strict_types=1);

namespace PcComponentes\Apixception\Core\Transformer;

final class NoSerializableTransformer extends ExceptionTransformer
{
    public function transform(\Throwable $exception): array
    {
        return [
            'exception' => \get_class($exception),
            'message' => $exception->getMessage(),
        ];
    }
}
