<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\HistoryCollection;
use App\Models\Currency;
use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collection = new CurrencyCollection(QueryBuilder::for(Currency::class)
            ->with(['latestRate'])
            ->allowedFilters([
                AllowedFilter::exact('numcode'),
                'charcode'
            ])
            ->paginate($request->get('size'))
            ->appends($request->input())

        );
        return response()->json($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Currency $currency
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        $currency->load('histories');
        return response($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
