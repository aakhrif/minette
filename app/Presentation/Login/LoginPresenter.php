<?php

declare(strict_types=1);

namespace App\Presentation\Login;

use App\Model\UserService;
use App\Presentation\BasePresenter;

final class LoginPresenter extends BasePresenter
{
  private UserService $userService;

  public function __construct(UserService $userService)
  {
    parent::__construct($userService);
    $this->userService = $userService;
  }

  public function actionDefault(): void
  {
    $request = $this->getHttpRequest();
    if ($request->getMethod() === 'POST') {
      $username = $request->getPost('username');
      $password = $request->getPost('password');

      //Login versuch
      if ($this->userService->login($username, $password)) {
        $this->flashMessage('Login erfolgreich', 'success');
        $this->redirect('Home:default');
      } else {
        $this->flashMessage('Login fehlgeschlagen', 'error');
      }
    }
  }

  public function actionLogout(): void
  {
    $this->userService->logout();

    $this->flashMessage('Du wurdest ausgeloggt.', 'success');
    $this->redirect('Home:default');
    $this->terminate();
  }
}
