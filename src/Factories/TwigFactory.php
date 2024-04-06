<?php

namespace Bolero\Plugins\FlashMessage\Factories;

use Bolero\Framework\Template\TwigFactoryInterface;
use Bolero\Plugins\FlashMessage\FlashMessage;
use Bolero\Plugins\FlashMessage\FlashMessageInterface;
use Twig\Environment;
use Twig\TwigFunction;

class TwigFactory implements TwigFactoryInterface
{

    public static function extendsTemplate(Environment $twig): Environment
    {
        $flashMessage = new FlashMessage();
        $twig->addFunction(new TwigFunction(
            'flashMessage',
            function () use ($flashMessage): FlashMessageInterface {
                return $flashMessage;
            }
        ));

        return $twig;
    }
}
