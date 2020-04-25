<?php
declare(strict_types=1);

namespace PcComponentes\Apixception\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('apixception');
        $treeBuilder
            ->getRootNode()
            ->arrayPrototype()
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('exception')
                        ->isRequired()
                        ->cannotBeEmpty()
                        ->defaultValue('\Throwable')
                    ->end()
                    ->scalarNode('transformer')
                        ->isRequired()
                        ->cannotBeEmpty()
                        ->defaultValue('PcComponentes\Apixception\Core\Transformer\NoSerializableTransformer')
                    ->end()
                    ->integerNode('http_code')
                        ->isRequired()
                        ->min(100)
                        ->max(599)
                        ->defaultValue(500)
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
