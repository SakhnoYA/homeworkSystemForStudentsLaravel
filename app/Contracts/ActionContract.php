<?php

namespace App\Contracts;

use App\Models\User;

interface ActionContract
{
    public function __invoke(array $data): User;
}
