<?php
namespace Pccomponentes\Apixception\Core\Exception;

class InvalidArgumentException extends \Exception implements SerializableException
{
    private $errors;

    public function __construct(InvalidArgumentError ...$errors)
    {
        $this->errors = $errors;
    }

    public function serialice(): array
    {
        return array_map(
            function (InvalidArgumentError $error) {
                return [
                    'parameter' => $error->parameter(),
                    'message' => $error->message()
                ];
            },
            $this->errors
        );
    }
}