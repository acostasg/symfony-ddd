<?php

namespace App\Core\Infrastucture\Bundle;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Provides an {@link ExtensionInterface} and {@link PrependExtensionInterface} implementation for {@link * CompactBundle}s. Defines conventions to be used among bundles.
 */
class CompactBundleExtension implements ExtensionInterface, PrependExtensionInterface
{
    /** @var CompactBundle the associated bundle */
    private $bundle;

    public function __construct(CompactBundle $bundle)
    {
        $this->bundle = $bundle;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configDir = new FileLocator($this->bundle->getPath().'/Resources/config');
        $loader = new YamlFileLoader($container, $configDir);
        $loader->load('services.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return Container::underscore($this->bundle->getName());
    }

    /**
     * {@inheritdoc}
     */
    public function getXsdValidationBasePath()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace(): string
    {
        return 'http://example.org/schema/dic/'.$this->getAlias();
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container): void
    {
        $this->prependDoctrineMappingConfiguration($container);
    }

    /**
     * Configures doctrine to add mapping files if doctrine config files are stored within this compact bundle in:
     *  <Bundle>/Resources/config/doctrine.
     */
    private function prependDoctrineMappingConfiguration(ContainerBuilder $container): void
    {
        $doctrineConfigs = sprintf('%s/Resources/config/doctrine', $this->bundle->getPath());
        if (is_dir($doctrineConfigs)) {
            $namespace = $this->bundle->getNamespace();
            $container->prependExtensionConfig('doctrine', [
                'orm' => [
                    'mappings' => [
                        $this->bundle->getName() => [
                            'type' => 'yml',
                            'dir' => 'Resources/config/doctrine',
                            'prefix' => substr($namespace, 0, $this->getPositionForNamespace($namespace)).'\\Domain',
                        ],
                    ],
                ],
            ]);
        }
    }

    private function getPositionForNamespace(string $namespace): int
    {
        return (int) strrpos($namespace, '\\');
    }
}
