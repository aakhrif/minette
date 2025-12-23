<?php

namespace App\Model;

use Nette\Http\Session;

class UserService
{
  private Session $session;
  private const SESSION_SECTION = 'auth';

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  public function login(string $username, string $password): bool
  {
    if ($username === 'test' && $password === '1234') {
      $section = $this->session->getSection(self::SESSION_SECTION);
      $section->userId = 1;
      $section->name = 'Test User';

      return true;
    }
    return false;
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

    return (object) [
      'id' => $section->userId,
      'name' => $section->name
    ];
  }

  public function isLoggedIn(): bool
  {
    return $this->getUser() !== null;
  }
}
