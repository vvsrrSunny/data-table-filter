<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessData extends Model
{
    use HasFactory;

    /**
     * Scope a query to only include filtering by name
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByName($query, string $name): Builder
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    /**
     * Scope a query to only include filtering by offices
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param $offices
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByOffices($query, $offices): Builder
    {
        return $query->where('offices', $offices);
    }
}
