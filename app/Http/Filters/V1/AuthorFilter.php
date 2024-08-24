<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;

class AuthorFilter extends QueryFilter {

    public function id($value)
    {
        $value = explode(',', $value);

        return $this->builder->whereIn('id', $value);
    }


    public function name($value)
    {
        $value = str_replace('*', '%', $value);

        return $this->builder->where('name', 'like', $value);
    }

    public function email($value)
    {
        $value = str_replace('*', '%', $value);

        return $this->builder->where('email', 'like', $value);
    }

    public function include($value)
    {
        $value = explode(',', $value);

        return $this->builder->with($value);
    }
}
