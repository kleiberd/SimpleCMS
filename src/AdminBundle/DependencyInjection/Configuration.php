<?php

namespace AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('admin');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->scalarNode('url_prefix')
                    ->defaultValue("/admin")
                ->end()
                ->arrayNode('menus')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('title')->end()
                            ->scalarNode('path')->end()
                            ->scalarNode('icon')->end()
                            ->scalarNode('parent')->end()
                            ->arrayNode('params')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('entities')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('entity')->end()
                            ->arrayNode('columns')
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('actions')
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('fields')
                                ->prototype('array')
                                    ->children()
                                        ->scalarNode('type')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('locales')
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
