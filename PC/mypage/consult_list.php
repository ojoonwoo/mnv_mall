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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_consult.png" alt="1대1 문의"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_dir?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>order_status.php"><span>주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>coupon.php"><span>쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>consult_list.php"><span class="active_underLine">1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="#"><span>개인정보 수정</span></a>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th>문의 날짜</th>
                      <th>문의 제목</th>
                      <th>답변</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="date">2016.08.17</td>
                      <td class="subject">배송] 언제 배송되나요?</td>
                      <td class="answer">답변대기</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="block_board_btn">
                <input type="button" value="문의하기" class="board_btn">
              </div>
              <div class="block_board_pager">
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
