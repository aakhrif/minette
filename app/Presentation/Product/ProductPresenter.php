<?php

declare(strict_types=1);

namespace App\Presentation\Product;

use App\Model\ProductService;
use App\Model\UserService;
use App\Presentation\BasePresenter;
use App\Security\ProductAuthorizator;
use Nette\Forms\Form;

final class ProductPresenter extends BasePresenter
{
    public function __construct(
        private ProductService $productService,
        private ProductAuthorizator $productAuthorizator,
        private UserService $userService
    ) {
        parent::__construct($userService);
    }

    public function renderDefault(): void
    {
        // $this->template->products = $this->productService->getAll();
    }

    public function actionEdit(int $id): void
    {
        $product = $this->productService->getById($id);

        if (!$product) {
            $this->error('Produkt nicht gefunden');
        }

        if (!$this->productAuthorizator->canEdit($this->user, $product)) {
            $this->error('Keine Berechtigung', 403);
        }

        $this->template->product = $product;
    }

    public function actionCreate(): void
    {
        // ob_start();
        $user = $this->userService->getUser();

        if (!$user) {
            // **Redirect ganz am Anfang**, bevor irgendwas ausgegeben wird
            $this->redirect('Login:default');
        }
    }
}
