<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Creating new repository: $name");

        // Cria o arquivo da classe
        $file = app_path("{$name}.php");
        file_put_contents($file, "teste");

        $this->info("Classe $name criada com sucesso!");
    }

    protected function configure()
    {
        $this->setName('make:repository')
            ->setDescription('Cria uma nova classe com o conteúdo especificado')
            ->addArgument('name', InputArgument::REQUIRED, 'O nome da nova classe')
            ->addOption('content', null, InputOption::VALUE_OPTIONAL, 'O conteúdo da nova classe', 'class {{name}} { }');
    }
}
