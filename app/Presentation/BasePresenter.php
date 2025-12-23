<?php

declare(strict_types=1);

namespace App\Presentation;

use App\Model\UserService;
use Nette\Application\UI\Presenter;

class BasePresenter extends Presenter
{
  private UserService $userService;

  public function __construct(UserService $userService)
  {
    parent::__construct();
    $this->userService = $userService;
  }

  protected function startup(): void
  {
    parent::startup();
    $this->template->currentUser = $this->userService->getUser();
  }
}
