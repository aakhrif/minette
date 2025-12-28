<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;

final class ProductService
{
  public function __construct(private Explorer $database) {}

  /** ToDo: import all products via csv
   *  Note: getAll is no option, impossible to get all products, use pagination instead
   */
  // public function getAll(): array
  // {
  // return [
  //   ['name' => 'Produkt A', 'price' => 19.99, 'image' => '/images/product1.png'],
  //   ['name' => 'Produkt B', 'price' => 29.99, 'image' => '/images/product2.png'],
  //   ['name' => 'Produkt C', 'price' => 9.99, 'image' => '/images/product3.png'],
  // ];
  //return $this->database->table('products')->getAll();
  // }

  public function getById(int $id): ?ActiveRow
  {
    return $this->database->table('products')
      ->where('is_active', 1)
      ->get($id);
  }

  public function getFeatured(int $limit = 8): Selection
  {
    return $this->database->table('products')
      ->where('is_featured', 1)
      ->where('is_active', 1)
      ->order('created_at DESC')
      ->limit($limit);
  }

  public function getPaginated(int $page, int $perPage = 24): Selection
  {
    return $this->database->table('products')
      ->where('is_active', 1)
      ->order('created_at DESC')
      ->page($page, $perPage);
  }

  public function createProduct(array $data, int $userId): void
  {
    $this->database->table('products')->insert([
      'name' => $data['name'],
      'price' => $data['price'],
      'user_id' => $userId,
      'is_active' => 1
    ]);
  }
}
