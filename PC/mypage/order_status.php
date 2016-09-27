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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_orderList.png" alt="주문조회"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_dir?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>order_status.php"><span class="active_underLine">주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>coupon.php"><span>쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_board_dir?>list_mtm.php"><span>1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="#"><span>개인정보 수정</span></a>
              </div>
              <div class="block_title alignC mb20">
                <p>주문번호를 클릭하시면 해당 주문에 대한 상세내역을 확인하실 수 있습니다.</p>
                <p>개별상품에 대한 배송조회는 상세내역에서 확인하시기 바랍니다.</p>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
                <table class="mypage_board_list order">
                  <thead>
                    <tr>
                      <th>주문일자</th>
                      <th>주문번호</th>
                      <th class="alignL pl30">주문상품</th>
                      <th>주문금액</th>
                      <th>주문처리상태</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><p>2016-09-01</p></td>
                      <td><p>16090121</p></td>
                      <td class="alignL pl30">
                        <p>카레그릇</p>
                        <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                      </td>
                      <td><p class="bold">20,000</p></td>
                      <td><p>배송중</p></td>
                    </tr>
<!-- 주문내역 없을때
                    <tr>
                      <td colspan="5">주문내역이 없습니다.</td>
                    </tr>
-->
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
