<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the Command is what users type after "php bin/console"
#[AsCommand(name: 'app:get-weather-data')]
class GetWeatherDataCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo "hellow world \n";
        // ... put here the code to create the user

        // this method must return an integer number with the "exit status code"
        // of the Command. You can also use these constants to make code more readable

        // return this if there was no problem running the Command
        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect Command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }
}