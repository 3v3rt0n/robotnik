<?php
$pair = "DXO/BTC";
$ticker = "DXO";
$url_dxo_price = "https://graviex.net/api/v2/tickers/dxobtc.json";
//$url_btc_price = "https://api.coindesk.com/v1/bpi/currentprice.json";
$coin_price=0;
$btc_price=0;
/* dados de trade */
$variacao_minima = 3.5; //3.5%
$max_btc_capital = 0.01;//0.01 BTC
$trades = 10; //open 10 positions
/* */
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_TIMEOUT,20);
curl_setopt($ch, CURLOPT_URL, $url_dxo_price);
$result = curl_exec($ch);
curl_close($ch);
$obj = json_decode($result);
//print_r($obj);
$coin_buy_price = $obj->ticker->buy;
$coin_sell_price = $obj->ticker->sell;
$coin_volume = $obj->ticker->vol;
$coin_btc_volume = $obj->ticker->volbtc;
echo "<br /><b>Ticker $ticker</b>";
echo "<br />Pair: ".$pair;
echo "<br /><br /><b>Ofertas</b>";
echo "<br />Compra: ".$coin_buy_price;
echo "<br />Venda: ".$coin_sell_price;
echo "<br /><br /><b>Volume</b>";
echo "<br />Coins: ".$coin_volume;
echo "<br />BTC: ".$coin_btc_volume;
//calcular margem entre preco de venda e de compra
$variacao_maxima = round((($coin_sell_price * 100)/$coin_buy_price)-100,2);
echo "<br /><br />Variacao Maxima: ".$variacao_maxima." %";
/* Se a variacao maxima for maior do que 3%, calcular */
if($variacao_maxima > $variacao_minima){
	//verificar qtde ordens abertas
	
	if($open_positions <= $trades){
		
	}
	
}
?>