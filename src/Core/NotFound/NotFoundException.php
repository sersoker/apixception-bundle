<?php
namespace Pccomponentes\Apixception\Core\NotFound;

abstract class NotFoundException extends \Exception
{
    abstract public function id(): string;
    abstract public function resource(): string;
}