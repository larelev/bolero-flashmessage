<?php

namespace Bolero\Plugins\FlashMessage;

use Bolero\Framework\Plugin\PluginContainerInterface;
use League\Container\DefinitionContainerInterface;

class Container implements PluginContainerInterface
{
    public static function provide(DefinitionContainerInterface $container): DefinitionContainerInterface
    {
        $container->addShared(
            \Bolero\Plugins\FlashMessage\FlashMessageInterface::class,
            \Bolero\Plugins\FlashMessage\FlashMessage::class,
        );

        return $container;
    }
}
