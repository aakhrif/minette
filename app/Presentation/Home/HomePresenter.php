<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\ProductService;
use Nette;


final class HomePresenter extends Nette\Application\UI\Presenter
{
  public function __construct(private ProductService $productService)
  {
    parent::__construct();
  }

  public function renderDefault(): void
  {
    $this->template->products = $this->productService->getAll();
  }
}
