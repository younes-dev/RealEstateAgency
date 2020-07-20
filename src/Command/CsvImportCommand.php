<?php
//src/Command/CsvImportCommand.php

namespace App\Command;

use App\Entity\User;
use ArrayIterator;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// References :  https://codereviewvideos.com/course/how-to-import-a-csv-in-symfony/video/importing-csv-data-the-easy-way
//            :  https://csv.thephpleague.com/9.0/writer/
//            :  https://csv.thephpleague.com/9.0/writer/
/**
 * Class CsvImportCommand
 * @package App\Command
 */
class CsvImportCommand extends Command
{

    const BATCH_SIZE = 1000; // As example

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    /**
     * Configure
     * @throws InvalidArgumentException
     */
    protected function configure()
    {
        $this
            ->setName('csv:import')
            // the short description shown while running "php bin/console csv:import"
            ->setDescription('Imports the importation CSV data file')
            //This option helps you to find a good value and use BATCH_SIZE constant as default
            ->addOption('fetch', 'f', InputArgument::OPTIONAL, 'Number of loop between each flush', self::BATCH_SIZE)
            // the "--help" option
            ->setHelp('This command allows you to import a user...')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws \League\Csv\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //##############################################################################
        //##########        read from csv file and insert to database        ###########
        //##############################################################################

//        $io = new SymfonyStyle($input, $output);
//        $reader= Reader::createFromPath("%kernel.root.dir%/../src/Data/USER_DATA.csv");
//        $io->progressStart(iterator_count($reader));
//
//        $reader->setHeaderOffset(0);
//        $records = Statement::create()->process($reader);
//        $records->getHeader(); //returns ['username', 'password']
//        foreach ($records as $record) {
//            $user = (new User())
//                ->setUsername($record['username'])
//                ->setPassword($record['password']);
//            $this->manager->persist($user);
//        $io->progressAdvance();
//        }
//        // save / write the changes to the database
//        $this->manager->flush();
//        $io->progressFinish();
//        $io->success('Command exited cleanly!');

        //##############################################################################
        //##########         write and insert $records into csv file         ###########
        //##############################################################################
        $io = new SymfonyStyle($input, $output);
        $records = [
            ['user11','123'],
            ['user12','123'],
            ['user13','123'],
        ];
        $io->progressStart(count($records));
        $io->confirm('Would you Create the Csv file?', true);
        $writer = Writer::createFromPath('%kernel.root.dir%/../src/Data/file.csv', 'w+');
        $writer->insertOne(['username', 'password']);
        $io->confirm('Would you fill the Csv file?', true);

        $writer->insertAll($records); //using an array
//        $writer->insertAll(new ArrayIterator($records)); //using a Traversable object
        $io->progressFinish();
        $io->success('Command exited cleanly!');

        //##############################################################################
        //##########    fetch users and create csv file data from table      ###########
        //##############################################################################

//        $io = new SymfonyStyle($input, $output);
//        $users=$this->manager->getRepository(User::class)->findAll();
//        $io->progressStart(iterator_count($users));
//        foreach ($users as $user) {
//            $records[]=[ $user->getUsername(),$user->getPassword()];
//        }
//
//        $writer = Writer::createFromPath('%kernel.root.dir%/../src/Data/file.csv', 'w+');
//        $writer->insertOne(['username', 'password']);
//        $writer->insertAll($records); //using an array
//        $io->success('Command exited cleanly!');

        //##############################################################################
        //##############################################################################
    }
}
