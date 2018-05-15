<?php
namespace Pccomponentes\Apixception;

use Pccomponentes\Apixception\DependencyInjection\ApixceptionExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApixceptionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
    }
}