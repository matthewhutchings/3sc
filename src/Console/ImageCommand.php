<?php

namespace Tsc\CatStorageSystem\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tsc\CatStorageSystem\Gif;
use Tsc\CatStorageSystem\Resources\Directory;

class ImageCommand extends Command {

    public function configure() {
        $this->setName('image')
            ->setDescription('Choose an image')
            ->addArgument('image', InputArgument::REQUIRED, 'What is the image name?')
            ->addOption('rename', 'r', InputOption::VALUE_REQUIRED, 'Rename A Cat', NULL)
            ->addOption('delete', 'd', InputOption::VALUE_NONE, 'Delete a Cat', NULL)
            ->addOption('create', 'c', InputOption::VALUE_NONE, 'Delete a Cat', NULL);
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $gif = new Gif();
        $directory = new Directory();

        if ($input->getOption('create')) {
            $cat = $gif->newImage('images/' . $input->getArgument('image'));
            $output->writeln("The cat has been born... He's a she! She's a he! He's a she-she.");
            die();
        }

        if ($input->getOption('rename')) {
            $question = new ConfirmationQuestion("Do you want to rehome this cat? ", false);
            $helper = $this->getHelper('question');
            if ($helper->ask($input, $output, $question)) {
                $gif->rename($input->getOption('rename'));
                $io->newLine();
                $output->writeln('You have re-homed this cat.');
                die();
            }

        }

        if ($input->getOption('delete')) {
            $helper = $this->getHelper('question');

            $question = new ConfirmationQuestion("I thought 3 Sided Cube build 'Tech For Good'. \r\n\r\nKilling a cat isn't Good.\r\n\r\nDo you wish to continue? ", false);

            if ($helper->ask($input, $output, $question)) {

                $gif->delete($input_image);
                $io->newLine();
                $output->writeln('You have just killed a cat.');
                $io->newLine();

                $question = new ConfirmationQuestion("Do you want to revive the cat?", false);
                if ($helper->ask($input, $output, $question)) {
                    $output->writeln("Reviving Cat...");
                    $progressBar = new ProgressBar($output, 100);
                    $progressBar->start();
                    $i = 0;while ($i++ < 100) {
                        usleep(15000);
                        $progressBar->advance();}$progressBar->finish();
                    $io->newLine();
                    $output->writeln("JK, it's dead...");
                }
                die();

            }

        }

        $cat = $gif->openImage('images/' . $input->getArgument('image'));

        $io->section('File Information');
        $io->text([
            'File Name: ' . $cat->getName(),
            'File Path: ' . $cat->getPath(),
            'File Size: ' . $cat->getSize(),
            'Created: ' . $cat->getCreatedTime()->format('Y-m-d H:i:s'),
            'Modified: ' . $cat->getModifiedTime()->format('Y-m-d H:i:s'),
        ]);

        $io->section('Folder Information');
        $io->text([
            'Folder Name: ' . $cat->parentDirectory->getName(),
            'Folder Path: ' . $cat->parentDirectory->getPath(),
            'Created: ' . $cat->parentDirectory->getCreatedTime()->format('Y-m-d H:i:s'),
        ]);

    }
}