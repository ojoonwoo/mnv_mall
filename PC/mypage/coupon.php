<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	if (!$_SESSION['ss_chon_id'])
	{
		echo "<script>alert('로그인 후 이용해 주세요.');</script>";
		echo "<script>location.href='".$_mnv_PC_member_url."member_login.php';</script>";
	}
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
            <div class="area_main_top nopadd">
              <div class="block_title">
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_coupon.png" alt="쿠폰"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>order_status.php"><span>주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>coupon.php"><span class="active_underLine">쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_board_url?>list_mtm.php"><span>1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_member_url?>modify_form.php"><span>개인정보 수정</span></a>
              </div>
              <div class="block_title alignC mb20">
                <p><b>쿠폰 인증번호 등록하기</b></p>
              </div>
            </div>
            <div class="area_main_middle nopadd noborder">
              <div class="block_bg mb30">
                <div class="block_copy alignC">
                  <input class="inputT" type="text" size="60">
                  <input type="button" value="등록하기" class="inputB">
                  <div class="guide_list noborder center">
                    <div class="guide_inner">
                      <div class="guide_block alignL">
                        <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>쿠폰인증번호 등록하기에게 쇼핑몰에서 발행한 종이쿠폰/시리얼쿠폰/모바일쿠폰 등의 인증번호를 등록하시면</p>
                        <p><span></span>온라인쿠폰으로 발급되어 사용이 가능합니다.</p>
                        <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>쿠폰은 주문시 1회에 한해 적용되며, 1회 사용시 재사용이 불가능합니다.</p>
                        <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>쿠폰은 적용 가능한 상품이 따로 설정되어 있는 경우 해당 상품 구매 시에만 사용이 가능합니다.</p>
                        <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>특정한 종이쿠폰/시리얼쿠폰/모바일쿠폰의 경우 단 1회만 사용이 가능할 수 있습니다.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table_block borderT">
                <table class="mypage_board_list order">
                  <thead>
                    <tr>
                      <th style="width:80px;">번호</th>
                      <th style="width:200px;">쿠폰명</th>
                      <th style="width:100px;">할인액(율)</th>
                      <th style="width:140px;">사용조건</th>
                      <th style="width:130px;">유효기간</th>
                      <th style="width:120px;">쿠폰종류</th>
                      <th style="width:120px;">적용대상</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="7">사용가능한 쿠폰이 없습니다.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="block_board_pager pt40">
                <span>
                  <a href="#"><img src="<?=$_mnv_PC_images_url?>arrow_left_double.png"></a>
                </span>
                <span>
                  <a href="#"><img src="<?=$_mnv_PC_images_url?>arrow_left_single.png"></a>
                </span>
                <a href="#"><span>1</span></a>
                <a href="#"><span>2</span></a>
                <a href="#"><span>3</span></a>
                <span>
                  <a href="#"><img src="<?=$_mnv_PC_images_url?>arrow_right_single.png"></a>
                </span>
                <span>
                  <a href="#"><img src="<?=$_mnv_PC_images_url?>arrow_right_double.png"></a>
                </span>
              </div>
            </div>
            <div class="area_main_bottom">

            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="<?=$_mnv_PC_images_url?>side_full.jpg">
            </div>
          </div>
        </div>
      </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
</html>
