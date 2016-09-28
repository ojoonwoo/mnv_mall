          <div class="area_list_title">
            <span class="list_title"><img src="<?=$_mnv_PC_images_url?>title_special.png" alt="스페셜 상품목록"></span>
          </div>
          <div class="list_product clearfix">
<?
	$plan_goods_info		= select_plan_goods_info($site_option['plan_goods_flag'],5);
	$i	= 0;
	foreach ($plan_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
		if ($val['discount_price'] == 0)
			$val['discount_price'] = $val['sales_price'];
?>
            <div class="product">
              <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>"></a>
              <div class="prd_info">
                <span class="prd_name"><?=$val['goods_name']?></span>
<?
	if ($val['sales_price'] != $val['discount_price'])
	{
?>
                <span class="prd_price"><?=number_format($val['sales_price'])?></span>
<?
	}
?>
                <span class="prd_sale"><?=number_format($val['discount_price'])?></span>
                <span class="prd_desc"><?=$val['goods_small_desc']?></span>
              </div>
            </div>
<?
		$i++;
	}
?>
          </div>

<!--
		  <div class="area_list_title">
            <span class="list_title no_line">스페셜</span>
          </div>
          <div class="list_product clearfix">
<?
	$plan_goods_info		= select_plan_goods_info($site_option['plan_goods_flag'],5);
	$i	= 0;
	foreach ($plan_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
		if ($val['discount_price'] == 0)
			$val['discount_price'] = $val['sales_price'];
?>
            <div class="product">
              <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>" style="width:220px"></a>
              <div class="prd_info">
                <span class="prd_name"><?=$val['goods_name']?></span>
                <span class="prd_price"><?=number_format($val['sales_price'])?></span>
                <span class="prd_sale"><?=number_format($val['discount_price'])?></span>
                <span class="prd_desc"><?=$val['goods_small_desc']?></span>
              </div>
            </div>
<?
		$i++;
	}
?>
          </div>
-->