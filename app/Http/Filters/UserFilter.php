<?php

namespace App\Http\Filters;

use Kblais\QueryFilter\QueryFilter;

class UserFilter extends QueryFilter
{
    /**
     * @param string $type
     */
    public function type(string $type)
    {
        if (!$type) {
            return $this;
        }
        return $this->where('user_type_id', $type);
    }

}
