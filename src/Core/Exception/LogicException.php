<?php
namespace Pccomponentes\Apixception\Core\Exception;

abstract class LogicException extends \Exception implements SerializableException
{
    public abstract function data(): array;

    public function serialice(): array
    {
        return  [
            'message' => $this->getMessage(),
            'data' => $this->data()
        ];
    }
}
