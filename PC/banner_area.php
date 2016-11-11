          <div class="area_banner">
            <div class="banner_slide">
<?
	$rolling_banner_info		= select_banner_info("main_rolling_banner", "PC");
	foreach ($rolling_banner_info as $key => $val)
	{
		$val['banner_img_url']	= str_replace("../../","",$val['banner_img_url']);
?>
              <div class="slide"><a href="<?=$val['banner_img_link']?>" target="<?=$val['banner_link_target']?>"><img src="<?=$val['banner_img_url']?>"></a></div>
<?
	}
	$image_banner_info		= select_banner_info("main_image_banner", "PC");
	$image_banner_info[0]['banner_img_url']	= str_replace("../../","",$image_banner_info[0]['banner_img_url']);
?>
            </div>
            <div class="banner_list clearfix">
              <div class="banner"><a href="<?=$_mnv_PC_url?>about_chon.php"><img src="./images/main_banner1.png" alt="배너_촌의 감각"></a></div>
              <div class="banner"><a href="<?=$_mnv_PC_url?>post_list.php"><img src="./images/main_banner2.png" alt="배너_매거진, 촌"></a></div>
              <div class="banner"><a href="https://www.instagram.com/chon.life/" target="_blank"><img src="./images/main_banner3.png" alt="배너_느린 그릇"></a></div>
            </div>
          </div>
