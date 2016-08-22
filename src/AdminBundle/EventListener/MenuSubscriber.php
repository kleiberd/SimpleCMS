<?php

namespace AdminBundle\EventListener;

use AdminBundle\Event\MenuEvent;
use AdminBundle\Event\MenuEvents;
use AdminBundle\Menu\Item\MenuItem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MenuSubscriber implements EventSubscriberInterface
{
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
            $item = new MenuItem('profile', 'profile');
            //$item->addChild(new MenuItem('show', 'profile_show', ['id' => 1]));
            $menu->addChild($item);
        }
    }
}