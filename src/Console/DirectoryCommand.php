<?php
namespace Tsc\CatStorageSystem\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tsc\CatStorageSystem\DirectoryManager;

class DirectoryCommand extends Command {

    public function configure() {
        $this->setName('directory')
            ->setDescription('Choose a directory')
            ->addArgument('directory', InputArgument::REQUIRED, 'What is the directory?');

    }
    public function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $directory = new DirectoryManager();
        $table = new Table($output);

        $dir = $input->getArgument('directory');

        $io->section('Directory Information');
        $io->text([
            'Size: ' . $directory->size($dir),
            'Directory Count: ' . $directory->directoryCount($dir),
            'File Count: ' . $directory->fileCount($dir),
        ]);

        $io->newLine();
        $io->section('Files');

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