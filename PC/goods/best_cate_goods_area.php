  <div>
    <h2>베스트 아이템</h2>
<?
	$new_goods_info		= 	select_cate_best_goods_info($cate_no, $site_option['cate_goods_flag'], 4);
	foreach ($new_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../","../",$val['goods_img_url']);
?>
    <div style="width:200px;float:left"><a href="goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>" style="width:200px" alt="<?=$val['goods_name']?>" title="<?=$val['goods_name']?>"></a></div>
<?
	}
?>
  </div>