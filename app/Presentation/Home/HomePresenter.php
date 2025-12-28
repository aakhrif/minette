<?php

declare(strict_types=1);

namespace App\Presentation\Home;

use App\Model\ProductService;
use App\Model\UserService;
use App\Presentation\BasePresenter;


final class HomePresenter extends BasePresenter
{
  public function __construct(private ProductService $productService, private UserService $userService)
  {
    parent::__construct($userService);
  }

  public function renderDefault(): void
  {
    //$this->template->products = $this->productService->getAll();
  }
}
