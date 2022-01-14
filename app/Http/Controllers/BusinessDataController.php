<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessDataRequest;
use App\Models\BusinessData;
use Illuminate\Http\Request;

class BusinessDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BusinessDataRequest $request)
    {
        if ($request->expectsJson()) {
            return BusinessData::query()
                ->when($request->filled('search'), fn ($query) => $query->searchByName($request->search))
                ->when($request->filled('offices'), fn ($query) => $query->searchByOffices($request->offices))
                ->when($request->filled('tables'), fn ($query) => $query->searchByTables($request->tables))
                ->when(
                    $request->filled(['square_meters.to', 'square_meters.from']),
                    fn ($query) => $query->searchBySquareMetersRange($request->input('square_meters.from'), $request->input('square_meters.to'))
                )
                ->when(
                    $request->filled(['price.to', 'price.from']),
                    fn ($query) => $query->searchByPriceRange($request->input('price.from'), $request->input('price.to'))
                )
                ->orderBy('name')
                ->paginate(5);
        }

        return view('dashboard');
    }
}
