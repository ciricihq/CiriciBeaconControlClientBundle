<?php

namespace Cirici\BeaconControlClientBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class PurgueApplicationsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cirici:beacon-control-client:purgue-applications')
            ->setDescription('DANGEROUS: Remove all the applications from beacon control')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->getContainer()->get('cirici_beacon_control_client.application_manager')->purgueAll();

        $output->writeln('all applications successful deleted');
    }
}
