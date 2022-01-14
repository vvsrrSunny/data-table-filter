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

    /**
     * Scope a query to only include filtering by tables
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param $tables
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByTables($query, $tables): Builder
    {
        return $query->where('tables', $tables);
    }

    /**
     * Scope a query to only include filtering by a range of square metres
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $from
     * @param string $to
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchBySquareMetersRange($query, string $from, string $to): Builder
    {
        return $query->whereBetween('square_meters', [$from, $to]);
    }

    /**
     * Scope a query to only include filtering by a range of price
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param string $from
     * @param string $to
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearchByPriceRange($query, string $from, string $to): Builder
    {
        return $query->whereBetween('price', [$from, $to]);
    }
}
