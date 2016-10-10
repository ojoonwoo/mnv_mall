<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	if (!$_SESSION['ss_chon_id'])
	{
		echo "<script>alert('로그인 후 이용해 주세요.');</script>";
		echo "<script>location.href='".$_mnv_PC_member_url."member_login.php';</script>";
	}
?>
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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_orderDetail.png" alt="주문상세내역"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>order_status.php"><span class="active_underLine">주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>coupon.php"><span>쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_board_url?>list_mtm.php"><span>1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_member_url?>modify_form.php"><span>개인정보 수정</span></a>
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
                      <td>
                        <p class="orderNum">123456622</p>
                        <input type="button" class="board_btn cancel" value="주문취소">
                      </td>
                      <td class="alignL pl30">
                        <p>카레그릇<span>(총 3종)</span></p>
                      </td>
                      <td><p class="bold">20,000</p></td>
                      <td>
                        <p>배송준비중</p>
                        <p>로젠택배 [23456]</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table_block mt30 borderT">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th>상품정보</th>
                      <th>판매가격</th>
                      <th>수량</th>
                      <th>합계</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="<?=$_mnv_PC_images_url?>order_list_img1.png" alt="주문상품1">
                        </div>
                        <div class="info_txt">
                          <h3>실용적인 사이즈의 머그컵</h3>
                          <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                        </div>
                      </td>
                      <td class="price">20,000</td>
                      <td class="count">
                        <p>1</p>
                      </td>
                      <td class="total">20,000</td>
                    </tr>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="<?=$_mnv_PC_images_url?>order_list_img1.png" alt="주문상품1">
                        </div>
                        <div class="info_txt">
                          <h3>실용적인 사이즈의 머그컵</h3>
                          <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                        </div>
                      </td>
                      <td class="price">20,000</td>
                      <td class="count">
                        <p>1</p>
                      </td>
                      <td class="total">20,000</td>
                    </tr>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="<?=$_mnv_PC_images_url?>order_list_img1.png" alt="주문상품1">
                        </div>
                        <div class="info_txt">
                          <h3>실용적인 사이즈의 머그컵</h3>
                          <p class="option">ㄴ [옵션 : 화이트 그릇]</p>
                        </div>
                      </td>
                      <td class="price">20,000</td>
                      <td class="count">
                        <p>1</p>
                      </td>
                      <td class="total">20,000</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form_header clearfix">
                <div class="lt_float">
                  <h2>주문자 정보</h2>
                </div>
              </div>
              <div class="table_block custom">
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문번호</p>
                  </div>
                  <div class="block_col">
                    <p>12323234234</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문하신분</p>
                  </div>
                  <div class="block_col">
                    <p>양선혜</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>휴대폰</p>
                  </div>
                  <div class="block_col">
                    <p>010-2515-4373</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제방법</p>
                  </div>
                  <div class="block_col">
                    <p>신용카드</p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제금액</p>
                  </div>
                  <div class="block_col">
                    <p>12,000원</p>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>배송 정보</h2>
                  </div>
                </div>
                <div class="table_block custom">
                  <div class="block_row">
                    <div class="block_col head">
                      <p>받으시는분</p>
                    </div>
                    <div class="block_col">
                      <p>양선혜</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>주소</p>
                    </div>
                    <div class="block_col">
                      <p>[137-844] 서울특별시 서초구 방배동 931-9 2층</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>휴대폰</p>
                    </div>
                    <div class="block_col">
                      <p>010-2515-4373</p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>배송메시지</p>
                    </div>
                    <div class="block_col">
                      <p>경비실에 맡겨주세요</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="block_order_price">
                <div class="inner clearfix">
                  <div class="price_block">
                    <h2>총 주문 금액</h2>
                  </div>
                  <div class="charImg">
                    <span class="bar1 long"></span>
                  </div>
                  <div class="price_block">
                    <h3>총 주문금액</h3>
                    <h3 class="total_order">80,000원</h3>
                  </div>
                  <div class="charImg">
                    <img src="<?=$_mnv_PC_images_url?>spec_plus.png">
                  </div>
                  <div class="price_block">
                    <h3>배송비</h3>
                    <h3 class="shipping">2,500원</h3>
                  </div>
                  <div class="charImg">
                    <img src="<?=$_mnv_PC_images_url?>spec_equal.png">
                  </div>
                  <div class="price_block">
                    <h3>총 결제금액</h3>
                    <h3 class="total_payment">82,500원</h3>
                  </div>
                </div>
              </div>
              <div class="block_btn mt30">
                <input type="button" value="주문목록" class="button_default">
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
