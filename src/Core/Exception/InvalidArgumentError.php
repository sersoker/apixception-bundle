<?php
namespace Pccomponentes\Apixception\Core\Exception;

class InvalidArgumentError
{
    private $parameter;
    private $message;

    public function __construct(string $parameter, string $message)
    {
        $this->parameter = $parameter;
        $this->message = $message;
    }

    public function parameter(): string
    {
        return $this->parameter;
    }

    public function message(): string
    {
        return $this->message;
    }
}