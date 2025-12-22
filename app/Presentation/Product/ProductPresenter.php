<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use Nette\Application\UI\Presenter;
use App\Model\ProductService;

final class ProductPresenter extends Presenter
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
