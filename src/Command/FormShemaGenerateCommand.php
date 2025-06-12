<?php

namespace App\Command;

use ApiPlatform\Metadata\IriConverterInterface;
use App\Entity\FormSchema;
use App\FormKit\Schema;
use App\Repository\FormSchemaRepository;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'FormShemaGenerate',
    description: 'Add a short description for your command',
)]
class FormShemaGenerateCommand extends Command {

    private ReflectionClass $reflection;
    private Schema $schema;

    public function __construct(protected FormSchemaRepository $repo, protected IriConverterInterface $iriConverter, #[Autowire('%kernel.project_dir%/src/Entity')] private $entitiesPath) {
        parent::__construct();

        // $this->reflection = new ReflectionClass($this->entitiesPath);
    }

    protected function configure(): void {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {

        $finder = new Finder();
        // find all files in the current directory
        $finder->files()->in($this->entitiesPath)->depth(0);
        $this->repo->all()->remove();
        foreach ($finder as $file) {
            $entity = $file->getFilenameWithoutExtension();
            $schema = $this->schema->clear()->getShema($entity);
            $this->repo->persist((new FormSchema())->setEntity($entity)->setSchema($schema));
        }
        $this->repo->flush();

        return Command::SUCCESS;


        return Command::FAILURE;


        $io = new SymfonyStyle($input, $output);
        // $arg1 = $input->getArgument('arg1');


        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }


        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
