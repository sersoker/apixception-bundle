<?php
namespace Pccomponentes\Apixception\Core;

use Symfony\Component\HttpFoundation\Response;

interface ApixceptionHandler
{
    public function match(\Exception $e): bool;
    public function makeResponse($e): Response;
}