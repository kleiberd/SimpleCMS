<?php

namespace AdminBundle\Menu;

use AdminBundle\Menu\Item\MenuItemInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Twig\TwigEngine;

interface MenuInterface
{
    /**
     * @return string
     */
    public function render();

    /**
     * @return TwigEngine
     */
    public function getTwigEngine();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return ArrayCollection
     */
    public function getChildren();

    /**
     * @param MenuItemInterface $item
     * @return $this
     */
    public function addChild(MenuItemInterface $item);
}