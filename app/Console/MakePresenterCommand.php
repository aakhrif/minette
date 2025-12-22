<?php

declare(strict_types=1);

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class MakePresenterCommand extends Command
{
  protected static $defaultName = 'make:presenter';

  protected function configure(): void
  {
    $this
      ->setDescription('Creates a Nette presenter with template')
      ->addArgument(
        'name',
        InputArgument::REQUIRED,
        'Presenter name (e.g. Product)'
      );
  }

  protected function execute(InputInterface $input, OutputInterface $output): int
  {
    $name = ucfirst((string) $input->getArgument('name'));

    $baseDir = dirname(__DIR__);

    // Nette 3+ Struktur
    $presenterDir = $baseDir . "/Presentation/{$name}";
    $presenterFile = $presenterDir . "/{$name}Presenter.php";
    $templateFile = $presenterDir . "/default.latte";

    if (!is_dir($presenterDir)) {
      mkdir($presenterDir, 0777, true);
    }

    if (!file_exists($presenterFile)) {
      file_put_contents(
        $presenterFile,
        <<<PHP
<?php

declare(strict_types=1);

namespace App\Presentation\\{$name};

use Nette\Application\UI\Presenter;

final class {$name}Presenter extends Presenter
{
    public function renderDefault(): void
    {
    }
}
PHP
      );
    }

    if (!file_exists($templateFile)) {
      file_put_contents(
        $templateFile,
        <<<LATTE
{block content}
<h1>{$name}</h1>
<p>{$name} presenter works.</p>
{/block}
LATTE
      );
    }

    $output->writeln("<info>Presenter {$name} created.</info>");

    return Command::SUCCESS;
  }
}
