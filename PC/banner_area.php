  <!-- <div class="slide_banner">
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
  </div> -->





          <div class="area_banner">
            <div class="banner_slide">
			1111223434343
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
            <div class="banner_list clearfix">
              <div class="banner"><a href="#"><div class="banner_bg1"><span class="over_txt">촌의 감각</span></div></a></div>
              <div class="banner"><a href="#"><div class="banner_bg2"><span class="over_txt">매거진, 촌</span></div></a></div>
              <div class="banner"><a href="#"><div class="banner_bg3"><span class="over_txt">느린 그릇</span></div></a></div>
            </div>
          </div>
