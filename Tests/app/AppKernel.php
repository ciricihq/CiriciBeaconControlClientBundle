<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array();

        if (in_array($this->getEnvironment(), array('test'))) {
            $bundles[] = new \Symfony\Bundle\FrameworkBundle\FrameworkBundle();
            $bundles[] = new \Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
            $bundles[] = new EightPoints\Bundle\GuzzleBundle\GuzzleBundle();
            $bundles[] = new Cirici\BeaconControlClientBundle\CiriciBeaconControlClientBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.yml');
    }
}