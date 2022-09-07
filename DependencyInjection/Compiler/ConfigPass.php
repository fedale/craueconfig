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
        $context = $container->getParameter('craue_config.context');
        $settings = $this->getSettings($context); 
        foreach ($settings as $setting) {
            $key = $setting['akey'];
            if($setting['bvalue'] == null){
                settype($setting['avalue'], $setting['acast']);
            }
            else {
                settype($setting['bvalue'], $setting['bcast']);
            }

            $value = isset($setting['bvalue']) ? $setting['bvalue'] : $setting['avalue'];
            
            $container->setParameter(
                $key,
                $value
            );
        }
    }

    private function getSettings($context = 'fedale')
    {
        $url = $_ENV['DATABASE_URL'];
        $conn = DriverManager::getConnection(['url' => $url]);

        $sql = "SELECT
            a.id AS aid,
            b.id AS bid,
            a.context AS acontext,
            b.context AS bcontext,
            a.section AS asection,
            a.active AS aactive,
            a.`key` AS akey,
            a.value AS avalue,
            b.`key` AS bkey,
            b.value AS bvalue,
            a.cast AS acast,
            b.cast AS bcast
            FROM setting a
            LEFT JOIN setting b
            ON (
                    (a.section, a.`key`) = (b.section, b.`key`)
                    AND b.context = :context
            )
            GROUP BY a.section, a.`key`";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue('context', $context);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }
        

}
