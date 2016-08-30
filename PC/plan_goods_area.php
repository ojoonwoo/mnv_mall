  <div>
    <h2>기획 상품</h2>
<?
	$plan_goods_info		= select_plan_goods_info($site_option['plan_goods_flag'],4);
	$i	= 0;
	foreach ($plan_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../","",$val['goods_img_url']);
?>
    <div style="width:200px;float:left"><a href="http://localhost/mnv_mall/PC/goods/goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>" style="width:200px" alt="<?=$val['goods_name']?>" title="<?=$val['goods_name']?>"></a></div>
<?
		$i++;
	}
?>
  </div>