<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Coin;

class CoinsDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function coinslist()
    {
        return Coin::all();
    }

    public function searchCoin(Request $request){
        $call = Http::get("https://api.coingecko.com/api/v3/coins/{$request['coin']}");
        $response = $call->json();
        $data = formatCoinData($response);
        saveCoin($data);

        return $data;
    }

    public function dateTimePriceSearch(Request $request){

        $call = Http::get("https://api.coingecko.com/api/v3/coins/{$request['coin']}/market_chart/range?vs_currency=usd&from={$request['from']}&to={$request['to']}");
        $response = $call->json();
        $length = count($response['prices']);
  
        return $response['prices'][($length - 1)];
    }

    public function currentPrice(){
        $params = formatParam(Coin::select('coin_id')->where('favorite', true)->get());
        $call = Http::get("https://api.coingecko.com/api/v3/simple/price?ids={$params}&vs_currencies=usd");
        $response = $call->json();
        updatePrices($response);
        
        return $response; 
    }

    public function favorite(Request $request){
        $query = Coin::where('coin_id', $request['id'])->update(['favorite' => $request['favorite']]);

        return $query;
    }

    public function populate(){
        $call = Http::get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=terra-luna-2%2C%20bitcoin%2C%20dacxi%2C%20cosmos%2C%20ethereum&order=market_cap_desc&per_page=100&page=1&sparkline=true&price_change_percentage=1h%2C%2024h%2C%207");
        $response = $call->json();
        $data = formatRequiredCoins($response);
        createFromArray($data);

        return $data;
    }
}
