<?php
namespace Pccomponentes\Apixception\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * FrameworkExtension configuration structure.
 *
 * @author Jeremy Mikola <jmikola@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder
            ->root('apixception')
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
                        ->defaultValue('Pccomponentes\Apixception\Core\Transformer\NoSerializableTransformer')
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
