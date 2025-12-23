<?php

namespace App\Model;

use Nette\Http\Session;

class UserService
{
  private Session $session;

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  public function login(string $username, string $password): bool
  {
    if ($username === 'test' && $password === '1234') {
      $this->session->getSection('auth')->user = (object)[
        'name' => 'Test User',
        'username' => $username
      ];
      return true;
    }
    return false;
  }

  public function logout(): void
  {
    $this->session->getSection('auth')->remove();
  }

  public function getUser(): ?object
  {
    return $this->session->getSection('auth')->user ?? null;
  }
}
