<?
	include_once "../../config.php";
	include_once "../header.php";

	$goods_code	= $_REQUEST['goods_code'];
	$goods_info	= select_goods_info($goods_code);
	$goods_info['goods_img_url']		= str_replace("../../","../",$goods_info['goods_img_url']);
	$current_cnt	= $goods_info['goods_stock'] - $goods_info['goods_sales_cnt'];
	if ($goods_info['goods_optionYN'] == "Y")
	{
		$goods_option_arr	= explode("||",$goods_info['goods_option_txt']);
	}
?>
<body>
<?
	// 상단 카테고리 영역
	include_once "../cate_navi.php";
?>
<input type="hidden" id="hd_sales_price" value="<?=$goods_info['sales_price']?>">
썸네일 : <img src="<?=$goods_info['goods_img_url']?>" style="width:200px"><br />
제품명 : <?=$goods_info['goods_name']?><br />
판매가 : <?=$goods_info['sales_price']?><br />
상품요약 : <?=$goods_info['goods_small_desc']?><br />
코드 : <?=$goods_info['goods_code']?><br />
<?
	if ($current_cnt < 1)
	{
?>
수량 : 품절 <a href="#">재입고요청</a> 
<?
	}else{
?>
수량 : <input type="text" value="1" id="buy_cnt"><input type="button" value="+" id="cnt_plus"><input type="button" value="-" id="cnt_minus"><br />
<?
	}
?>
<?
	if ($goods_info['goods_optionYN'] == "Y")
	{
		foreach($goods_option_arr as $key => $val)
		{
			$final_option_arr			= explode("|+|",$val);
			$final_option__sel_arr	= explode(";",$final_option_arr[1]);
?>
  <?=$final_option_arr[0]?> : 
  <select>
<?
			foreach($final_option__sel_arr as $key2 => $val2)
			{
?>
    <option><?=$val2?></option>
<?
			}
?>
  </select>
  <br />
<?
		}
	}
?>
  -----------------------------------------------------------------------------------
  <br />
  총 상품금액(수량) <span id="total_price"><?=number_format($goods_info['sales_price'])?></span>원 (<span id="total_cnt">1</span>개) <br />
  <a href="#">구매하기</a> <a href="#">장바구니</a> <a href="#">위시리스트</a>
</body>
</html>