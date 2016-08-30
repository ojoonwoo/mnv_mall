  <div class="slide_banner">
<?
	$rolling_banner_info		= select_banner_info("main_rolling_banner");

	foreach ($rolling_banner_info as $key => $val)
	{
		$val['banner_img_url']	= str_replace("../../","",$val['banner_img_url']);
?>
    <div class="slide"><a href="<?=$val['banner_img_link']?>" target="<?=$val['banner_link_target']?>"><img src="<?=$val['banner_img_url']?>"></a></div>
<?
	}
	$image_banner_info		= select_banner_info("main_image_banner");
	$image_banner_info[0]['banner_img_url']	= str_replace("../../","",$image_banner_info[0]['banner_img_url']);
?>
  </div>
  <div style="width:100%;height:300px">
<?
	$image_banner_info		= select_banner_info("main_image_banner");

	$i	= 0;
	foreach ($image_banner_info as $key => $val)
	{
		//$image_banner_info[0]['banner_img_url']	= str_replace("../../","",$image_banner_info[0]['banner_img_url']);
		$val['banner_img_url']	= str_replace("../../","",$val['banner_img_url']);
?>
    <div style="width:200px;float:left"><a href="<?=$val['banner_img_link']?>" target="<?=$val['banner_link_target']?>"><img src="<?=$val['banner_img_url']?>" style="width:200px" alt="<?=$val['idx']?>" title="<?=$val['idx']?>"></a></div>
<?
		$i++;
	}
?>
  </div>