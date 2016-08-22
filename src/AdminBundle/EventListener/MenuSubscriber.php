<?php

namespace AdminBundle\EventListener;

use AdminBundle\Event\MenuEvent;
use AdminBundle\Event\MenuEvents;
use AdminBundle\Menu\Item\MenuItem;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuSubscriber implements EventSubscriberInterface, ContainerAwareInterface
{
    protected $container;

    public static function getSubscribedEvents()
    {
        return [
            MenuEvents::MENU => 'onMenu'
        ];
    }

    public function onMenu(MenuEvent $event)
    {
        $menu = $event->getMenu();

        if ($menu->getName() === 'admin_menu') {
            if (!empty($this->container->getParameter('admin.menus'))) {
                foreach($this->container->getParameter('admin.menus') as $name => $configItem) {
                    $item = new MenuItem(
                        $name,
                        $configItem['title'],
                        (isset($configItem['path']) ? $configItem['path'] : null),
                        (isset($configItem['params']) ? $configItem['params'] : array()),
                        (isset($configItem['icon']) ? $configItem['icon'] : null));

                    if (isset($configItem['parent'])) {
                        $parent = $menu->getChild($configItem['parent'])->first();
                        $parent->addChild($item);
                    } else {
                        $menu->addChild($item);
                    }
                }
            }
        }
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}