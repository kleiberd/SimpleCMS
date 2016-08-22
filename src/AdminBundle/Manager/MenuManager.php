<?php

namespace AdminBundle\Manager;

use AdminBundle\Menu\Item\MenuItem;
use AdminBundle\Menu\Menu;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RequestStack;

class MenuManager extends ContainerAware
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getMenu($name)
    {
        return $this->container->get($name);
    }

    public function getService($name)
    {
        return $this->container->get($name);
    }

    public function getActiveItem(Menu $menu)
    {
        $request = $this->requestStack->getMasterRequest();

        $routeName = $request->get('_route');

        foreach ($menu->getChildren() as $item) {
            if ($item = $this->getInnerActive($item, $routeName)) {
                return $item;
            }
        }

        return null;
    }

    protected function getInnerActive(MenuItem $item, $routeName)
    {
        if ($routeName === $item->getPath()) {
            return $item;
        } else {
            foreach ($item->getChildren() as $item) {
                if ($item = $this->getInnerActive($item, $routeName)) {
                    return $item;
                }
            }
        }

        return false;
    }
}