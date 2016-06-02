<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Liip\FunctionalTestBundle\LiipFunctionalTestBundle(),
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        // $loader->load(__DIR__.'/config.yml');

        // graciously stolen from https://github.com/javiereguiluz/EasyAdminBundle/blob/master/Tests/Fixtures/App/AppKernel.php#L39-L45
        if ($this->isSymfony3()) {
            $loader->load(function (ContainerBuilder $container) {
                $container->loadFromExtension('framework', array(
                    'assets' => null,
                ));
            });
        }
    }

    protected function isSymfony3()
    {
        return 3 === Kernel::MAJOR_VERSION;
    }
}
