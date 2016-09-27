          <div class="area_list_title pdt45">
            <span class="list_title"><img src="<?=$_mnv_PC_images_url?>title_best.png" alt="베스트 상품목록"></span>
          </div>
          <div class="list_product clearfix">
<?
	$best_goods_info		= select_best_goods_info($site_option['best_goods_flag'],5);
	$i	= 0;
	foreach ($best_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
?>
            <div class="product">
              <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>"></a>
              <div class="prd_info"><span class="prd_name"><?=$val['goods_name']?></span></div>
            </div>
<?
		$i++;
	}
?>
          </div>

<!--
		  <div class="area_list_title">
            <span class="list_title">베스트</span>
          </div>
          <div class="list_product clearfix">
<?
	$best_goods_info		= select_best_goods_info($site_option['best_goods_flag'],5);
	$i	= 0;
	foreach ($best_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
?>
            <div class="product">
              <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>" style="width:220px"></a>
              <div class="prd_info"><span class="prd_name"><?=$val['goods_name']?></span></div>
            </div>
<?
		$i++;
	}
?>
          </div>
-->