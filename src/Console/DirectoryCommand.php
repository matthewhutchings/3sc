<?php
namespace Tsc\CatStorageSystem\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tsc\CatStorageSystem\DirectoryManager;

class DirectoryCommand extends Command {

    public function configure() {
        $this->setName('directory')
            ->setDescription('Choose a directory')
            ->addArgument('directory', InputArgument::REQUIRED, 'What is the directory?')
            ->addOption('create', 'c', InputOption::VALUE_NONE, 'Create directory', NULL)
            ->addOption('rename', 'r', InputOption::VALUE_REQUIRED, 'Rename directory', NULL)
            ->addOption('delete', 'd', InputOption::VALUE_NONE, 'Delete directory', NULL);
    }

    // // Create Directory within Images
    // //$directory->createRootDirectory('tythy2');

// //$directory->delete('tythy');

// //print_r($directory->rename('hello12', 'hello1'));
    public function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);

        $dir = $input->getArgument('directory');
        $directory = new DirectoryManager();

        if ($input->getOption('create')) {
            $directory->createRootDirectory($dir);
            $output->writeln("Directory has been create");
            die();
        }

        if ($input->getOption('delete')) {
            $directory->delete($dir);
            $output->writeln("Directory has been deleted");
            die();
        }

        if ($input->getOption('rename')) {
            $directory->rename($dir, $input->getOption('rename'));
            $output->writeln("Directory has been renamed to " . $input->getOption('rename'));
            die();
        }
        $io->section('Directory Information');
        $io->text([
            'Size: ' . $directory->size($dir),
            'Directory Count: ' . $directory->directoryCount($dir),
            'File Count: ' . $directory->fileCount($dir),
        ]);

        $io->newLine();
        $io->section('Files');

        $io = new SymfonyStyle($input, $output);
        $table = new Table($output);

        $table->setHeaders(['File Name', 'Type', 'Size (bytes)', 'Modified (Unix)'])
            ->setRows($directory->listFiles($dir))
            ->render();

        $io->newLine();
        $io->section('Directories');

        $table->setHeaders(['Name', 'Type', 'Size (bytes)', 'Modified (Unix)'])
            ->setRows($directory->listDirectories($dir))
            ->render();
    }
}