<?php

namespace App\Http\Filters\V1;

use Illuminate\Database\Eloquent\Builder;

class TicketFilter extends QueryFilter {

    protected $sortable = [
        'title',
        'status',
        'createdAt' => 'created_at',
        'updatedAt' => 'updated_at',
    ];

    public function status($value)
    {
        return $this->builder->where('status', $value);
    }

    public function title($value)
    {
        $value = str_replace('*', '%', $value);

        return $this->builder->where('title', 'like', $value);
    }

    public function include($value)
    {
        $value = explode(',', $value);

        return $this->builder->with($value);
    }
}
