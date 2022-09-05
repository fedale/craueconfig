<?php 

namespace Craue\ConfigBundle\DependencyInjection\Compiler;

// use App\Mail\TransportChain;

use Craue\ConfigBundle\Entity\Setting;
use Craue\ConfigBundle\Util\Config;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container): void
    {
        // $conn = $container->get('doctrine.orm.default_entity_manager')->getConnection();
        // $settings = $conn->fetchAllAssociative('SELECT * FROM setting');
        // foreach ($settings as $setting) {
        //     $container->setParameter($setting['key'], $setting['value']);
        // }
        
        $em = $container->get('doctrine.orm.default_entity_manager');
        $settings = $em->getRepository(Setting::class)->findAll();

        // $conn = $container->get('doctrine.orm.default_entity_manager')->getConnection();
        // $settings = $conn->fetchAllAssociative('SELECT * FROM setting');
        foreach ($settings as $setting) {
            $container->setParameter($setting['key'], $setting['value']);
        }

        // dump($container);
        
        // die('ConfigPass');
        // // always first check if the primary service is defined
        // if (!$container->has(TransportChain::class)) {
        //     return;
        // }

        // $definition = $container->findDefinition(TransportChain::class);

        // // find all service IDs with the app.mail_transport tag
        // $taggedServices = $container->findTaggedServiceIds('app.mail_transport');

        // foreach ($taggedServices as $id => $tags) {
        //     // add the transport service to the TransportChain service
        //     $definition->addMethodCall('addTransport', [new Reference($id)]);
        // }
    }

}
