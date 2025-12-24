<?php

namespace App\Model;

use Nette\Http\Session;
use Nette\Database\Explorer;

class UserService
{
  private const SESSION_SECTION = 'auth';

  public function __construct(
    private Explorer $database,
    private Session $session
  ) {}

  public function login(string $email, string $password): bool
  {
    $user = $this->database
      ->table('users')
      ->where('email', $email)
      ->fetch();

    if (!$user) {
      return false;
    }

    if (!password_verify($password, $user->password_hash)) {
      return false;
    }

    $this->session->getSection(self::SESSION_SECTION)->userId = $user->id;

    return true;
  }

  public function logout(): void
  {
    $this->session->getSection(self::SESSION_SECTION)->remove();
  }

  public function getUser(): ?object
  {
    $section = $this->session->getSection(self::SESSION_SECTION);

    if (!isset($section->userId)) {
      return null;
    }

    return $this->database
      ->table('users')
      ->get($section->userId);
  }

  public function isLoggedIn(): bool
  {
    return $this->getUser() !== null;
  }
}
