<?php

namespace Hamlet\Command;

use Hamlet\TestRunner\SimpleTest\OutputReporterFacade;
use Hamlet\TestRunner\SimpleTest\SimpleTestRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunTestsCommand extends Command
{
    protected $rootDirectoryPath;

    public function __construct($rootDirectoryPath)
    {
        parent::__construct();
        $this->rootDirectoryPath = $rootDirectoryPath;
    }

    protected function configure()
    {
        $this
            ->setName('test')
            ->setDescription('Run tests')
            ->addArgument('class', InputArgument::OPTIONAL, 'Test class name to run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $runner = new SimpleTestRunner(new OutputReporterFacade($output));
        $className = $input->getArgument('class');
        if ($className != null && !class_exists($className)) {
            $output->writeln('Cannot load class ' . $className);
            return 1;
        } else {
            return $runner->execute($this->rootDirectoryPath, $className) ? 0 : 1;
        }
    }
}