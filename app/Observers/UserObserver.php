<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function saved(User $user): void
    {
        $this->clearCache($user);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $this->clearCache($user);
    }

    private function clearCache(User $user): void
    {
        $lastPage = ceil(User::count() / config('constants.options.paginate_number'));
        $cacheKey = "cached_users_{$user->user_type_id}_page_$lastPage";
        Cache::forget($cacheKey);

        $cacheKeyAll = "cached_users__page_$lastPage";
        Cache::forget($cacheKeyAll);
    }

}
