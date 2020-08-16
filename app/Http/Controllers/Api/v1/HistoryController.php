<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Resources\CurrencyCollection;
use App\Http\Resources\HistoryCollection;
use App\Models\Currency;
use App\Models\History;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $collection = new HistoryCollection(QueryBuilder::for(History::class)
//            ->with(['latestRate'])
            ->allowedFilters([
                AllowedFilter::exact('currency_id'),
                AllowedFilter::scope('date_between', 'dateBetween'),

            ])
            ->paginate($request->get('size'))
            ->appends($request->input())

        );
        return response()->json($collection);
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
}
