<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class RememberMeService
{
    /**
     * Set default minutes expiration
     *
     * @var int
     */
    protected int $minutesExpiration = 10080; //equivalent of 30 days

    /**
     * Customize the user logged remember me expiration
     *
     * @param Authenticatable $user
     */
    public function setRememberMeExpiration(Authenticatable $user): void
    {
        Cookie::queue($this->getRememberMeSessionName(), encrypt($this->setRememberMeValue($user)), $this->minutesExpiration);
    }

    /**
     * Generate remember me value
     *
     * @param $user
     * @return string
     */
    protected function setRememberMeValue($user): string
    {
        return $user->id . "|" . $user->remember_token . "|" . $user->password;
    }

    /**
     * Get remember me session name
     *
     * @return string
     */
    protected function getRememberMeSessionName(): string
    {
        return Auth::getRecallerName();
    }
}
