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
            'route' => 'mems_top'
        ]);
        $menu->addChild('Losuj', [
            'route' => 'mems_show_rand'
        ]);
        
        return $menu;
    }
    
    public function userMenuAuthenticated(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
    
        $menu->addChild('Konto', ['uri' => '#'])
            ->setAttribute('class', 'dropdown')
            ->setLinkAttribute('class', 'dropdown-toggle')
            ->setLinkAttribute('data-toggle', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Konto']->addChild('Profil', array('route' => 'fos_user_profile_edit'));
        $menu['Konto']->addChild('Dodaj mema', array('route' => 'mems_add'));
        
        $menu['Konto']->addChild('Wyloguj', array('route' => 'fos_user_security_logout'));
    
        return $menu;
    }
    
    public function userMenuNotAuthenticated(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
        
        $menu->addChild('Zaloguj', ['uri' => '#'])
            ->setAttribute('class', 'dropdown')
            ->setLinkAttribute('class', 'dropdown-toggle')
            ->setLinkAttribute('data-toggle', 'dropdown')
            ->setChildrenAttribute('class', 'dropdown-menu');
        $menu['Zaloguj']->addChild('Zaloguj', [
            'route' => 'fos_user_security_login'
        ]);
        $menu['Zaloguj']->addChild('Zaloguj poprzez facebook', [
            'route' => 'facebook_login'
        ]);
        
        $menu->addChild('Zarejestruj', [
            'route' => 'fos_user_registration_register'
        ]);
    
        return $menu;
    }
}