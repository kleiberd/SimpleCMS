<?php

namespace AdminBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class LastRouteSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        $request = $event->getRequest();
        $session = $request->getSession();

        $routeName = $request->get('_route');
        $routeParams = $request->get('_route_params');
        if ($routeName[0] == '_') {
            return;
        }
        $routeData = ['name' => $routeName, 'params' => $routeParams];

        $thisRoute = $session->get('this_route', []);
        if ($thisRoute == $routeData) {
            return;
        }
        $session->set('last_route', $thisRoute);
        $session->set('this_route', $routeData);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
        );
    }
}