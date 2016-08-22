<?php

namespace AdminBundle\Menu;

use AdminBundle\Menu\Item\MenuItemInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Twig\TwigEngine;

class Menu implements MenuInterface
{
    protected $twigEngine;

    protected $name;

    protected $view;

    protected $children;

    /**
     * Menu constructor.
     * @param $name
     * @param TwigEngine $twigEngine
     */
    public function __construct($name, TwigEngine $twigEngine)
    {
        $this->name = $name;
        $this->view = 'AdminBundle:_menu:menu.html.twig';
        $this->twigEngine = $twigEngine;
        $this->children = new ArrayCollection();
    }

    /**
     * @param null $view
     * @return string
     */
    public function render($view = null)
    {
        $menuView = ($view ?: $this->view);

        return $this->twigEngine->render($menuView, [
            'items' => $this->children
        ]);
    }

    /**
     * @return TwigEngine
     */
    public function getTwigEngine()
    {
        return $this->twigEngine;
    }

    /**
     * @param TwigEngine $twigEngine
     * @return $this
     */
    public function setTwigEngine(TwigEngine $twigEngine)
    {
        $this->twigEngine = $twigEngine;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return $this
     */
    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * @param MenuItemInterface $item
     * @return $this
     */
    public function addChild(MenuItemInterface $item)
    {
        if (!$this->children->contains($item)) {
            $this->children->add($item);
        }

        return $this;
    }

    /**
     * @param MenuItemInterface $item
     * @return $this
     */
    public function removeChild(MenuItemInterface $item)
    {
        $this->children->removeElement($item);

        return $this;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }
}