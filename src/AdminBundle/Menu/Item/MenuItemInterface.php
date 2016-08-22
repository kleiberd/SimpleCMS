<?php

namespace AdminBundle\Menu\Item;

use Doctrine\Common\Collections\ArrayCollection;

interface MenuItemInterface
{
    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @param string $path
     */
    public function setPath($path);

    /**
     * @param array $params
     */
    public function setParams($params);

    /**
     * @param string $icon
     */
    public function setIcon($icon);

    /**
     * @param MenuItemInterface $parent
     */
    public function setParent($parent);

    /**
     * @param ArrayCollection $children
     */
    public function setChildren($children);

    /**
     * @param MenuItemInterface $item
     * @return MenuItemInterface
     */
    public function addChild(MenuItemInterface $item);
}