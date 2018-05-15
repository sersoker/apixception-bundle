<?php
namespace Pccomponentes\Apixception\Core\Exception;

abstract class NotFoundException extends \Exception implements SerializableException
{
    public abstract function id(): string;
    public abstract function resource(): string;

    public function serialice(): array
    {
        return  [
            'id' => $this->id(),
            'resource' => $this->resource()
        ];
    }
}