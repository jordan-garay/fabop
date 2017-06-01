<?php

// src/AppBundle/Command/CreateUserCommand.php

namespace UserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SendinBlue\SendinBlueApiBundle\Wrapper\Mailin;

class GetAllListCommand extends Command {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('sendinblue:get-all-list')

                // the short description shown while running "php bin/console list"
                ->setDescription('Get all the list information')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('This command let you access all the list information under the account.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $cle = ['api_key' => '9ROQwEhyfb35MInx', 'timeout' => 5000];
        $mailin = new Mailin($cle);

        $data = array( "listids" => array(12),
      "page" => 1,
      "page_limit" => 200
    );
 
    var_dump($mailin->display_list_users($data));
    }

}
