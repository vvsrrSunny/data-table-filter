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
                ->orderBy('name')
                ->paginate(5);
        }

        return view('dashboard');
    }
}
