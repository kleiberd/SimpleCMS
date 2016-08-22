<?php

namespace AdminBundle\Menu;

use AdminBundle\Event\MenuEvent;
use AdminBundle\Event\MenuEvents;
use Symfony\Bridge\Twig\TwigEngine;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MenuBuilder
{
    protected $twigEngine;

    protected $dispatcher;

    /**
     * MenuBuilder constructor.
     * @param TwigEngine $twigEngine
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(TwigEngine $twigEngine, EventDispatcherInterface $eventDispatcher)
    {
        $this->twigEngine = $twigEngine;
        $this->dispatcher = $eventDispatcher;
    }

    /**
     * @param $name
     * @return Menu
     */
    public function get($name)
    {
        $menu = new Menu($name, $this->twigEngine);

        $this->dispatcher->dispatch(MenuEvents::MENU, new MenuEvent($menu));

        return $menu;
    }
}