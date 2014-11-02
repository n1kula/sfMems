<?php

namespace Mems\LayoutBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Strona główna', [
            'route' => 'mems_list'
        ]);
        $menu->addChild('Poczekalnia', [
            'route' => 'mems_unaccepted_list'
        ]);
        $menu->addChild('Top', [
            'uri' => '#'
        ]);
        $menu->addChild('Losuj', [
            'uri' => '#'
        ]);
        
        return $menu;
    }
    
    public function userMenuAuthenticated(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
    
        $menu->addChild('User', ['uri' => '#'])
            ->setAttribute('class', 'dropdown')
            ->setLinkAttribute('class', 'dropdown-toggle')
            ->setLinkAttribute('data-toggle', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['User']->addChild('Profil', array('route' => 'fos_user_profile_edit'));
        $menu['User']->addChild('Dodaj mema', array('route' => 'mems_new'));
        
        $menu['User']->addChild('Wyloguj', array('route' => 'fos_user_security_logout'));
    
        return $menu;
    }
    
    public function userMenuNotAuthenticated(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
    
        $menu->addChild('Zaloguj', [
            'route' => 'fos_user_security_login'
        ]);
    
        return $menu;
    }
}