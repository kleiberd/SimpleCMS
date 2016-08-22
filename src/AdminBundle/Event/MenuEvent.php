<?php

namespace AdminBundle\Event;

use AdminBundle\Menu\Menu;
use Symfony\Component\EventDispatcher\Event;

class MenuEvent extends Event
{
    protected $menu;

    /**
     * MenuEvent constructor.
     * @param Menu $menu
     */
    function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }
}