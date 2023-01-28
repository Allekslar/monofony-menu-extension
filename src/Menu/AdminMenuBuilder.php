<?php


declare(strict_types=1);

namespace Allekslar\MonofonyMenuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Monofony\Component\Admin\Menu\AdminMenuBuilderInterface;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class AdminMenuBuilder implements AdminMenuBuilderInterface
{
    public const EVENT_NAME = 'sylius.menu.admin.main';

    public function __construct(
        private FactoryInterface $factory,
        private EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function createMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $this->addCustomerSubMenu($menu);
        $this->addConfigurationSubMenu($menu);

        $this->eventDispatcher->dispatch(new MenuBuilderEvent($this->factory, $menu), self::EVENT_NAME);

        return $menu;
    }

    private function addCustomerSubMenu(ItemInterface $menu): void
    {
        $customer = $menu
            ->addChild('customer')
            ->setLabel('sylius.ui.customer')
        ;

        $customer->addChild('backend_customer', [
            'route' => 'sylius_backend_customer_index',
        ])
            ->setLabel('sylius.ui.customers')
            ->setLabelAttribute('icon', 'users');
    }

    private function addConfigurationSubMenu(ItemInterface $menu): void
    {
        $configuration = $menu
            ->addChild('configuration')
            ->setLabel('sylius.ui.configuration')
        ;

        $configuration->addChild('backend_admin_user', [
            'route' => 'sylius_backend_admin_user_index',
        ])
            ->setLabel('sylius.ui.admin_users')
            ->setLabelAttribute('icon', 'lock');
    }
}
