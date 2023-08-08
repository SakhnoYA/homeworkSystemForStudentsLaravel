<?php

namespace App\Actions;

use App\Models\User;
use App\Contracts\ActionContract;
class RegisterUserAction implements ActionContract
{

    public function __invoke(array $data): User
    {
        // TODO: Implement __invoke() method.
    }
}
