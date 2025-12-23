<?php

use App\Model\UserService;
use Nette\Application\UI\Presenter;

final class LoginPresenter extends Presenter
{
  private UserService $userService;

  public function __construct(UserService $userService)
  {
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
}
