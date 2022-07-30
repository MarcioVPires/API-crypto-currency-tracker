<?php

use App\Models\Coin;

function formatRequiredCoins($response){
    $data = array();

    foreach($response as $coin){
        $newcoin = array();

        $newcoin['coin_id'] = $coin['id'];
        $newcoin['symbol'] = $coin['symbol'];
        $newcoin['name'] = $coin['name'];
        $newcoin['image'] = $coin['image'];
        $newcoin['current_price'] = $coin['current_price'];
        $newcoin['market_cap'] = $coin['market_cap'];
        $newcoin['total_volume'] = $coin['total_volume'];
        $newcoin['price_change_percentage_24h'] = $coin['price_change_percentage_24h'];
        $newcoin['price_change_percentage_1h_in_currency'] = $coin['price_change_percentage_1h_in_currency'];
        $newcoin['favorite'] = true;
        array_push($data, $newcoin);
    }
    
    return $data;
}

function createFromArray($data){
    foreach($data as $coin){  
        Coin::create([
            'coin_id' => $coin['coin_id'],
            'symbol' => $coin['symbol'],
            'name' => $coin['name'],
            'image' => $coin['image'],
            'current_price' => $coin['current_price'],
            'market_cap' => $coin['market_cap'],
            'total_volume' => $coin['total_volume'],
            'price_change_percentage_24h' => $coin['price_change_percentage_24h'],
            'price_change_percentage_1h_in_currency' => $coin['price_change_percentage_1h_in_currency'],
            'favorite' => $coin['favorite'],
        ]);
    }
}

function formatCoinData($response){
    $data = array();


    $data  = array();
    $data ['coin_id'] = $response['id'];
    $data ['symbol'] = $response['symbol'];
    $data ['name'] = $response['name'];
    $data ['image'] = $response['image']['large'];
    $data ['current_price'] = $response['market_data']['current_price']['usd'];
    $data ['market_cap'] = $response['market_data']['market_cap']['usd'];
    $data ['total_volume'] = $response['market_data']['total_volume']['usd'];
    $data ['price_change_percentage_24h'] = $response['market_data']['price_change_percentage_24h'];
    $data ['price_change_percentage_1h_in_currency'] = $response['market_data']['price_change_percentage_1h_in_currency']['usd'];
    $data ['favorite'] = false;
       
    return $data;
}

function saveCoin($data){
     
    Coin::create([
        'coin_id' => $data['coin_id'],
        'symbol' => $data['symbol'],
        'name' => $data['name'],
        'image' => $data['image'],
        'current_price' => $data['current_price'],
        'market_cap' => $data['market_cap'],
        'total_volume' => $data['total_volume'],
        'price_change_percentage_24h' => $data['price_change_percentage_24h'],
        'price_change_percentage_1h_in_currency' => $data['price_change_percentage_1h_in_currency'],
        'favorite' => $data['favorite'],
    ]);
    
}

function formatParam($params){
    $formated = "";
    $i = 0;
    $length = count($params);
    
    while ($i < $length){
        $formated = $formated . (($i == 0) ? '' : '%2C') . $params[$i]['coin_id'];
        $i++;
    }

    return $formated;
}

function updatePrices($newPrices){
    foreach($newPrices as $key => $value){  
        Coin::where('coin_id', $key)->update(['current_price' => $value['usd']]);
    }
}

//composer dump-autoload

//php artisan cache:clear
//php artisan config:clear
