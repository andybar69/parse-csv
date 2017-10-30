<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Helpers\DataHandler;
use AppBundle\Helpers\ImportRules;
use AppBundle\Helpers\Output\OutputFactory;

/**
 * Class MyCommand
 * @package AppBundle\Command
 */
class MyCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:parse-csv')
            ->setDescription('Hello PhpStorm')
            ->addArgument('mode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $upload_dir = $this->getContainer()->getParameter('upload_directory');

        try {
            $obj = new DataHandler(new ImportRules(), realpath($upload_dir));
            $obj->process();

            $strategy = OutputFactory::create($input->getArgument('mode'));
            $obj->setStrategy($strategy);

            $em = $this->getContainer()->get('doctrine.orm.entity_manager');
            $obj->saveOutput($em);
        }
        catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
