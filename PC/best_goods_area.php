  <div style="width:100%;height:300px">
    <h2>베스트 상품</h2>
<?
	$best_goods_info		= select_best_goods_info($site_option['best_goods_flag'],4);
	$i	= 0;
	foreach ($best_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../","",$val['goods_img_url']);
?>
    <div style="width:200px;float:left"><a href="http://localhost/mnv_mall/PC/goods/goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>" style="width:200px" alt="<?=$val['goods_name']?>" title="<?=$val['goods_name']?>"></a></div>
<?
		$i++;
	}
?>
  </div>