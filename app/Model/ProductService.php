<?php

declare(strict_types=1);

namespace App\Model;

final class ProductService
{
  public function getAll(): array
  {
    return [
      ['name' => 'Produkt A', 'price' => 19.99, 'image' => '/images/product1.png'],
      ['name' => 'Produkt B', 'price' => 29.99, 'image' => '/images/product2.png'],
      ['name' => 'Produkt C', 'price' => 9.99, 'image' => '/images/product3.png'],
    ];
  }
}
