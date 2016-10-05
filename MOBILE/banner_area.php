      <section id="Banner">
        <div class="slideArea">
          <div class="slider swiper-container">
            <ul class="banner_slide swiper-wrapper">
<?
	$rolling_banner_info		= select_banner_info("main_rolling_banner");
	foreach ($rolling_banner_info as $key => $val)
	{
		$val['banner_img_url']	= str_replace("../../","",$val['banner_img_url']);
?>
              <li class="swiper-slide">
                <a href="<?=$val['banner_img_link']?>" target="<?=$val['banner_link_target']?>">
                  <img src="<?=$val['banner_img_url']?>">
                </a>
              </li>
<?
	}
	$image_banner_info		= select_banner_info("main_image_banner");
	$image_banner_info[0]['banner_img_url']	= str_replace("../../","",$image_banner_info[0]['banner_img_url']);
?>
            </ul>
          </div>
          <div class="pager">
            <ul class="bx-pager">
              <li><a href="#" data-slide-index="0">1</a></li>
              <li><a href="#"data-slide-index="1">2</a></li>
              <li class="active" data-slide-index="2"><a href="#">3</a></li>
              <li><a href="#" data-slide-index="3">4</a></li>
            </ul>
          </div>
          <div class="fixBanner">
            <ul>
              <li>
                <a href="#">
                  <img src="./images/banner1.png" alt="촌의감각">
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="./images/banner2.png" alt="매거진,촌">
                </a>
              </li>
              <li>
                <a href="#">
                  <img src="./images/banner3.png" alt="인스타그램">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>
