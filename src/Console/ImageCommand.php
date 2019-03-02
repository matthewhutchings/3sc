<?php
namespace Tsc\CatStorageSystem\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Tsc\CatStorageSystem\DirectoryManager;
use Tsc\CatStorageSystem\GifClass;

class ImageCommand extends Command {

    public function configure() {
        $this->setName('image')
            ->setDescription('Choose an image')
            ->addArgument('image', InputArgument::REQUIRED, 'What is the image name?');

    }
    public function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $gif = new GifClass();
        $directory = new DirectoryManager();

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