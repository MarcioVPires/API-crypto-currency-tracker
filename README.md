# Crypto Currency Tracker API

> This repository will report about the BackEnd part of the FullStack test to see the FrontEnd report please [Acess This Link](https://github.com/MarcioVPires/crypto-currency-tracker)

## Installing

To install this project and run locally follow the steps bellow:

Download or Clone the repository:

```
git clone git@github.com:MarcioVPires/api-crypto-currency-tracker.git
```

Install the dependencies:

```
npm install
```

Run the project:

```
php artisan serve
```


### Local DataBase

I used Postgres in this project, you can use any sql based db, the only thing you have to do is to fill the .env variables with the credentials of the db you will use.

For that, access the .env file in the root directory, locate the lines of code below and fill with your info.
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_test
DB_USERNAME=postgres
DB_PASSWORD=password
```

### Endpoints & Functionalities

The baseURL for all endpoint is: **api-crypto-currency-tracker.herokuapp.com/api**

1️⃣ **List**
```
/coins
```
Returns all the coins in the DB with the following format:
```
[
	{
	"id": 1,
	"coin_id": "bitcoin",
	"symbol": "btc",
	"name": "Bitcoin",
	"image": "https:\/\/assets.coingecko.com\/coins\/images\/1\/large\/bitcoin.png?1547033579",
	"current_price": "23419.00000000",
	"market_cap": 454720580470,
	"total_volume": 40505595383,
	"price_change_percentage_24h": "0.08",
	"price_change_percentage_1h_in_currency": "-0.17",
	"favorite": true,
	"created_at": "2022-07-30T02:57:04.000000Z",
	"updated_at": "2022-08-01T04:27:29.000000Z"
},
{
	"id": 2,
	"coin_id": "ethereum",
	"symbol": "eth",
	"name": "Ethereum",
	"image": "https:\/\/assets.coingecko.com\/coins\/images\/279\/large\/ethereum.png?1595348880",
	"current_price": "1693.77000000",
	"market_cap": 204969740163,
	"total_volume": 21268656995,
	"price_change_percentage_24h": "-0.20",
	"price_change_percentage_1h_in_currency": "0.36",
	"favorite": true,
	"created_at": "2022-07-30T02:57:04.000000Z",
	"updated_at": "2022-08-01T04:27:29.000000Z"
}
]

...more
```
&nbsp;

2️⃣ **Search Coin**
```
/search-coins-name
```
This request needs a json body with the coin_id of the currency. **Always put the value in lowercase**
```
{
	"coin": "litecoin"
}
```

First the api search for the coin in the coingecko endpoint *api.coingecko.com/api/v3/coins/{$request['coin']}*
Then it formats the response using only the data we will need, save in the DB and return to the user
```
{
	"id": 1,
	"coin_id": "bitcoin",
	"symbol": "btc",
	"name": "Bitcoin",
	"image": "https:\/\/assets.coingecko.com\/coins\/images\/1\/large\/bitcoin.png?1547033579",
	"current_price": "23419.00000000",
	"market_cap": 454720580470,
	"total_volume": 40505595383,
	"price_change_percentage_24h": "0.08",
	"price_change_percentage_1h_in_currency": "-0.17",
	"favorite": true,
	"created_at": "2022-07-30T02:57:04.000000Z",
	"updated_at": "2022-08-01T04:27:29.000000Z"
},

```
&nbsp;

3️⃣ **Search Coin price based on date and time**
```
/search-coins-date-time
```
This request needs a json body with the coin_id and two timestamps in unix format.
**from** = one hour earlier from the date/ time you really want. 
**to** = The date/ time you really want. 
```
{
	"coin": "bitcoin",
	"from": 1659233460,
	"to": 1659237060
}
```
The response will cointain all the price changes from 1h earlier to the given time.Then the api selects the last price change and send to the user
```
[
	1659237013038,
	23806.989534889515
]
```
&nbsp;

4️⃣ **Current Price**
```
/get-current-price
```

This endpoint will return a list of prices of all coins in the DB marked as favorite
```
{
	"cosmos": {
		"usd": 10.59
	},
	"dacxi": {
		"usd": 0.00175708
	},
	"terra-luna-2": {
		"usd": 1.93
	},
	"bitcoin": {
		"usd": 23418
	},
	"ethereum": {
		"usd": 1694.14
	}
}
```
&nbsp;

5️⃣ **Favorite**
```
/favorite
```
This request needs a json body with the coin_id and a boolean value.
```
{
	"id": "dogecoin",
	"favorite": true
}
```
This endpoint will change the favorite status of any coin in the DB

&nbsp;

6️⃣ **Populate**
```
/populate
```

This a **"development endpoint" only**. It's used to put all the required coins in the database.
This allows the dev to easely put data on DB in case the DB needs to be deleted or moved.
&nbsp;

> All the endpoint was create and its working. But not all of then its used in the FrontEnd right now.

# Improvements

There's a lot of room for improvements, some of the things I have in mind:

- Error Treatment for every data handling in te api.
- Configure cors to only accept calls from a specific URL
- A login functionality to allow the front end to pull the new favorite coins from the DB instead of localStorage


