<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$cate_no	= $_REQUEST['cate_no'];
	$sub_cate_info	= sub_category_info($cate_no);
?>
  <body>
    <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
      <div id="wrap_content">
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="area_main_top">
              <div class="block_title">
                <p class="cate_title"><img src="../images/cate_title_plate.png" alt="그릇"></p>
              </div>
              <div class="area_list_title left">
                <span class="list_title pr_head"><img src="../images/left_title_best.png" alt="베스트"></span>
              </div>
              <div class="list_product clearfix">
<?
	$best_goods_info		= select_best_goods_info($site_option['best_goods_flag'],4);
	$i	= 0;
	foreach ($best_goods_info as $key => $val)
	{
		$val['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$val['goods_img_url']);
?>
                <div class="product n4">
                  <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$val['goods_code']?>"><img src="<?=$val['goods_img_url']?>"></a>
                  <div class="prd_info"><span class="prd_name"><?=$val['goods_name']?></span></div>
                </div>
<?
	}
?>
              </div>
            </div>
            <div class="area_main_middle">
              <div class="detail_menu">
                <div class="nav clearfix">
                  <div class="left_cate">
<?
	$i = 1;
	$sub_cate_num	= count($sub_cate_info);
	foreach($sub_cate_info as $key => $val)
	{
		$sub_cate_arr	= explode("||",$val);
?>
                    <a href="#">
                      <span class="cate_name"><?=$sub_cate_arr[0]?><span class="cate_amount">(<?=$sub_cate_arr[1]?>)</span></span>
                    </a>
<?
		if ($i != $sub_cate_num)
		{
?>
                    <span class="bar3"></span>
<?
		}
		$i++;
	}
?>
                    <!-- <a href="#">
                      <span class="cate_name">밥공기<span class="cate_amount">(2)</span></span>
                    </a>
                    <span class="bar3"></span>
                    <a href="#">
                      <span class="cate_name">국그릇<span class="cate_amount">(3)</span></span>
                    </a>
                    <span class="bar3"></span>
                    <a href="#">
                      <span class="cate_name">컵<span class="cate_amount">(10)</span></span>
                    </a> -->
                  </div>
                  <div class="right_cate">
                    <a href="#">
                      <span class="cate_name">LOW PRICE</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#">
                      <span class="cate_name">HIGH PRICE</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#">
                      <span class="cate_name">NAME</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#">
                      <span class="cate_name">NEW</span>
                    </a>
                    <span class="bar_slash">/</span>
                    <a href="#">
                      <span class="cate_name">REVIEW</span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="list_product clearfix">
                <div class="product n4">
                  <a href="#"><img src="../images/product_n4_default.jpg"></a>
<!--                  <div class="prd_info"><span class="prd_name">제품명</span></div>-->
                </div>
                <div class="product n4">
                  <a href="#"><img src="../images/product_n4_default.jpg"></a>
<!--                  <div class="prd_info"><span class="prd_name">제품명</span></div>-->
                </div>
                <div class="product n4">
                  <a href="#"><img src="../images/product_n4_default.jpg"></a>
<!--                  <div class="prd_info"><span class="prd_name">제품명</span></div>-->
                </div>
                <div class="product n4">
                  <a href="#"><img src="../images/product_n4_default.jpg"></a>
<!--                  <div class="prd_info"><span class="prd_name">제품명</span></div>-->
                </div>
              </div>
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="../images/side_full.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC"><img src="../images/customer_center.png" alt="고객센터"></span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon"><img src="../images/about_chon.png" alt="about 촌의감각"></span></a>
              <a href="#"><span class="sugg"><img src="../images/sugg_store.png" alt="입점문의"></span></a>
              <a href="#"><span class="sugg"><img src="../images/sugg_partnership.png" alt="제휴문의"></span></a>
              <a href="#"><span class="sugg last"><img src="../images/heavy_buying.png" alt="대량구매"></span></a>
            </div>
            <div class="box_info sns clearfix">
              <a href="#"><span>인스타그램</span></a>
              <a href="#"><span>페이스북</span></a>
              <a href="#"><span>블로그</span></a>
            </div>
          </div>
        </div>
        <div class="address">
          <p>company  미니버타이징(주)  address  서울특별시  서초구  방배동  931-9  2F</p>
          <p>owner  양선혜    business  license  114  87  11622   privacy policy | terms of use</p>
          <br>
          <p>@chon all rights reserved</p>
        </div>
      </div>
    </div>
  </body>
</html>