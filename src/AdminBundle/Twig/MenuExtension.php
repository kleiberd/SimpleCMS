<?php

namespace AdminBundle\Twig;

use AdminBundle\Manager\MenuManager;

class MenuExtension extends \Twig_Extension
{
    protected $menuManager;

    public function __construct(MenuManager $menuManager)
    {
        $this->menuManager = $menuManager;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('admin_menu', [$this, 'renderMenu'], ['is_safe' => ['html']])
        ];
    }

    public function renderMenu($name)
    {
        $menu = $this->menuManager->getMenu($name);

        return $menu->render();
    }

    public function getName()
    {
        return 'admin_menu_extension';
    }
}