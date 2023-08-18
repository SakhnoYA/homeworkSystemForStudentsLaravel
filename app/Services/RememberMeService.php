<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RememberMeService
{
    /**
     * Set default minutes expiration
     */
    protected int $minutesExpiration = 10080;

    /**
     * Customize the user logged remember me expiration
     */
    public function setRememberMeExpiration(Authenticatable $user): void
    {
        Cookie::queue(
            $this->getRememberMeSessionName(),
            encrypt($this->setRememberMeValue($user)),
            $this->minutesExpiration
        );
    }

    /**
     * Generate remember me value
     */
    protected function setRememberMeValue($user): string
    {
        return $user->id.'|'.$user->remember_token.'|'.$user->password;
    }

    /**
     * Get remember me session name
     */
    protected function getRememberMeSessionName(): string
    {
        return Auth::getRecallerName();
    }
}
