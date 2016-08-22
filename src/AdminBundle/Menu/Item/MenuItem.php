<?php

namespace AdminBundle\Menu\Item;

use Doctrine\Common\Collections\ArrayCollection;

class MenuItem implements MenuItemInterface
{
    protected $name;

    protected $title;

    protected $path;

    protected $params;

    protected $icon;

    protected $children;

    protected $parent;

    /**
     * MenuItem constructor.
     * @param $name
     * @param $title
     * @param null $path
     * @param array $params
     * @param null $icon
     */
    public function __construct($name, $title, $path = null, array $params = [], $icon = null)
    {
        $this->name = $name;
        $this->title = $title;
        $this->path = $path;
        $this->params = $params;
        $this->icon = $icon;
        $this->children = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param null $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return null
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param null $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param MenuItemInterface $item
     * @return $this
     */
    public function addChild(MenuItemInterface $item)
    {
        if (!$this->children->contains($item)) {
            $this->children->add($item);
            $item->setParent($this);
        }

        return $this;
    }

    /**
     * @param MenuItemInterface $item
     * @return $this
     */
    public function removeChild(MenuItemInterface $item)
    {
        if (!$this->children->contains($item)) {
            $item->setParent(null);
        }

        $this->children->removeElement($item);

        return $this;
    }
}