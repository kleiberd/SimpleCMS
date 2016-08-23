<?php

namespace AdminBundle\Twig;

use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VariableExtension extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getLocale()
    {
        $request = $this->container->get('request');

        return $request->getLocale();
    }

    public function getLocales()
    {
        return $this->container->getParameter('admin.locales');
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('locale', [$this, 'getLocale']),
            new \Twig_SimpleFunction('locales', [$this, 'getLocales'])
        ];
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'admin_variable_extension';
    }
}