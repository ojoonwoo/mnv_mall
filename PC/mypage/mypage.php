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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_mypage.png" alt="마이페이지"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>order_status.php"><span>주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>coupon.php"><span>쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_board_url?>list_mtm.php"><span>1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_member_url?>modify_form.php"><span>개인정보 수정</span></a>
              </div>
            </div>
            <div class="area_main_middle nopadd noborder">
              <div class="mypage_main">
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_mypage_dir?>mycart.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_basket.png" alt="장바구니"></h2>
                      <p>
                      고객님께서 담아두셨던 상품내역을<br>
                      확인하실 수 있습니다.
                      </p>
                    </a>
                  </div>
                </div>
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_mypage_dir?>wishlist.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_wish.png" alt="관심상품"></h2>
                      <p>관심상품으로 등록하신 상품의 목록을 보여드립니다.</p>
                    </a>
                  </div>
                </div>
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_mypage_dir?>order_status.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_order.png" alt="주문내역"></h2>
                      <p>
                      고객님께서 주문하신 상품의 주문내역을 확인하실 수 있습니다.<br>
                      비회원의 경우, 주문서의 주문번호와 비밀번호로 주문조회가 가능합니다.
                      </p>
                    </a>
                  </div>
                </div>
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_mypage_dir?>coupon.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_coupon.png" alt="쿠폰"></h2>
                      <p>고객님이 보유하고 계신 쿠폰내역을 보여드립니다.</p>
                    </a>
                  </div>
                </div>
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_board_url?>list_mtm.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_qna.png" alt="1대1맞춤상담"></h2>
                      <p>
                      고객님의 궁금하신 문의사항에 대하여
                      1:1 맞춤상담 내용을 확인하실 수 있습니다.
                      </p>
                    </a>
                  </div>
                </div>
                <div class="mypage_block">
                  <div class="block_inner">
                    <a href="<?=$_mnv_PC_member_url?>modify_form.php">
                      <h2><img src="<?=$_mnv_PC_images_url?>mypage_cate_title_modifyInfo.png" alt="개인정보수정"></h2>
                      <p>
                      회원이신 고객님의 개인정보를 관리하는 공간입니다.
                      개인정보를 최신 정보로 유지하시면 보다 간편히 쇼핑을 즐기실 수 있습니다.
                      </p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="area_main_bottom">

            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="<?=$_mnv_PC_images_url?>side_full_img1.jpg">
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
