<?php 

namespace Craue\ConfigBundle\DependencyInjection\Compiler;

// use App\Mail\TransportChain;

use Craue\ConfigBundle\Entity\Setting;
use Craue\ConfigBundle\Util\Config;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Doctrine\DBAL\DriverManager;

class ConfigPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container): void
    {
        $url = $_ENV['DATABASE_URL'];
        $conn = DriverManager::getConnection(['url' => $url]);

        $sql = 'SELECT * FROM setting';
        $settings = $conn->fetchAllAssociative($sql);
        foreach ($settings as $setting) {
            settype($setting['value'], $setting['cast']);
            $container->setParameter(
                $setting['key'], 
                $setting['value']
            );
        }
    }

}
