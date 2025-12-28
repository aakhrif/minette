<?php

declare(strict_types=1);

namespace App\Security;

use Nette\Security\User;
use Nette\Database\Table\ActiveRow;

final class ProductAuthorizator
{
  public function canEdit(User $user, ActiveRow $product): bool
  {
    if (!$user->isLoggedIn()) {
      return false;
    }

    if ($user->isInRole('admin')) {
      return true;
    }

    return $product->user_id === $user->getId();
  }

  public function canDelete(User $user, ActiveRow $product): bool
  {
    return $this->canEdit($user, $product);
  }
}
