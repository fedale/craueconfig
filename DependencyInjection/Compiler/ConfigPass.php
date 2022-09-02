<?php 

namespace Craue\ConfigBundle\DependencyInjection\Compiler;

// use App\Mail\TransportChain;

use Craue\ConfigBundle\Util\Config;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConfigPass implements CompilerPassInterface
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function process(ContainerBuilder $container): void
    {
        dump($this->config->all());
        $container->setParameter('superAdmin', 'foo');
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
