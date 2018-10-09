<?php
/* ------------------------------------------- */
/* ------------ Trader Bot v1.0 ---------------*/
/* ------------------------------------------- */
$pair = "dxobtc";
$ticker = "DXO";

$coin_price=0;
$btc_price=0;
$open_positions=0;

/* ---------------------- */
/* --- dados de trade --- */
/* ---------------------- */
//$url_btc_price = "https://api.coindesk.com/v1/bpi/currentprice.json";
$variacao_minima = 3.5; //3.5%
$max_btc_capital = 0.00100000; //0.001 BTC
$max_trades = 10; //open max 10 positions
$max_coin_capital = 2000;
//porcentagens do coin capital usado em cada ordem
$vetor_parts = array(1,3,5,8,10,13,15,20,25);
/* ----------------------- */
/* -- Getting prices -- */
/* ----------------------- */
function get_market_default($pair){
	$url_coin_price = "https://graviex.net/api/v2/tickers/".$pair.".json";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_TIMEOUT,20);
	curl_setopt($ch, CURLOPT_URL, $url_coin_price);
	$result = curl_exec($ch);
	curl_close($ch);
	$obj = json_decode($result);
	//print_r($obj);
	$coin_buy_price = $obj->ticker->buy;
	$coin_sell_price = $obj->ticker->sell;
	$coin_volume = $obj->ticker->vol;
	$coin_btc_volume = $obj->ticker->volbtc;
	echo "<br /><b>Pair</b>: ".$pair;
	echo "<br /><br /><b>Ofertas</b>";
	echo "<br />Compra: ".$coin_buy_price;
	echo "<br />Venda: ".$coin_sell_price;
	echo "<br /><br /><b>Volume last 24h</b>";
	echo "<br />Coins: ".$coin_volume;
	echo "<br />BTC: ".$coin_btc_volume;
	return array('buy' => $coin_buy_price,'sell' => $coin_sell_price,'vol' => $coin_volume,'volbtc' => $coin_btc_volume);
}

function get_order_book($pair,$bids_limit=1,$asks_limit=1){
	$url_order_book = "https://graviex.net:443//api/v2/order_book.json?market=$pair&asks_limit=$asks_limit&bids_limit=$bids_limit";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_TIMEOUT,20);
	curl_setopt($ch, CURLOPT_URL, $url_order_book);
	$result = curl_exec($ch);
	curl_close($ch);
	$obj = json_decode($result);
	echo "<br />";
	echo "<br /><b>Asks</b>";
	//print_r($obj->asks[0]);
	echo "<br />".$obj->asks[0]->remaining_volume;
	echo "<br />".$obj->asks[0]->price;
	echo "<br />".$obj->asks[0]->at;
	echo "<br />".$obj->asks[0]->created_at;
	echo "<br />";
	echo "<br /><b>Bids</b>";	
	//print_r($obj->bids[0]);
	echo "<br />".$obj->bids[0]->remaining_volume;
	echo "<br />".$obj->bids[0]->price;
	echo "<br />".$obj->bids[0]->at;
	echo "<br />".$obj->bids[0]->created_at;
}

/*
---
Este bot tem como finalidade vender pelo maior preço e comprar pelo menor preço uma altcoin.
Ele é ideal para um order book em que a variacao entre o preço de venda e preço de compra é maior do que 3%
---
Processo de venda - Sempre maior preço possivel
1)verifica se tem saldo de altcoin
2)Se sim, dividir o montante de altcoin inicial em porcoes ( vetor parts 1%,3%,5%,10%,15%,20%,21%,25%)
3)Abrir ordem de venda a cada X minutos de cada porcao, pelo maior preço possivel (1 sat a menos que a ultima ordem) a altcoin começando pela porção maior
4)Se vender, inicia processo de venda novamente com uma nova porção.*/
function  sell_process(){
	
}
/*
Processo de compra - sempre menor preço possivel
1)Verifica se tem saldo de btc
2) Se sim, dividir o montante de altcoin inicial em porcoes ( vetor parts 1%,3%,5%,10%,15%,20%,21%,25%)
3) Abrir ordem de compra a cada X minutos de cada porção,  pelo menor preço possivel (1 sat a mais que a ultima ordem) o saldo btc começando pela porção menor
4) Se comprar, inicia o processo de compra denovo
5) Se nao comprar, inicia um processo de compra novamente com uma nova porção
*/
function buy_process(){
	
}

function orders_count(){
	
}

function check_market(){
	
}

function max_variation($coin_buy_price,$coin_sell_price){
	$variacao_maxima = round((($coin_sell_price * 100)/$coin_buy_price)-100,2);
	echo "<br /><br />Variacao Maxima: ".$variacao_maxima." %";
	return $variacao_maxima;
}
/* ---------------------------------------------------------- */
/* ------------ Verificar possibilidade de trade ------------ */
/* ---------------------------------------------------------- */
$dados_mercado = get_market_default($pair);
$variacao_max = max_variation($dados_mercado['buy'],$dados_mercado['sell']);
get_order_book($pair);
/* Se a variacao maxima for maior do que 3%, continua operacoes */
if($variacao_max > $variacao_minima){
	//verificar volume de compra e de venda imediata
	
	//contar qtde ordens abertas pelo bot
	
	if($open_positions <= $max_trades){
		
	}
	
}
?>