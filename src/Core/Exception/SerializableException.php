<?php
namespace Pccomponentes\Apixception\Core\Exception;

interface SerializableException extends \Throwable
{
    public function serialice(): array;
}