<?php

namespace Craue\ConfigBundle;

use Craue\ConfigBundle\DependencyInjection\Compiler\SettingPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Craue\ConfigBundle\Util\Config;

/**
 * @author Christian Raue <christian.raue@gmail.com>
 * @copyright 2011-2022 Christian Raue
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class CraueConfigBundle extends Bundle {
    
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SettingPass(), PassConfig::TYPE_REMOVE, -1000);
        $container->addCompilerPass(new SettingPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION);
    }
}
