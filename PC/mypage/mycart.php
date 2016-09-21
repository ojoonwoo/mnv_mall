<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_basket.png" alt="장바구니"></p>
              </div>
              <div class="mypage_cate_hori nopadd">
                <a href="#"><span class="active_underLine">장바구니</span></a>
<?
	// 마이페이지 헤더 영역
	include_once $_mnv_PC_mypage_dir."mypage_header.php";
?>
              </div>
              <div class="main_top_block clearfix">
                <div class="rt_float">
                  <p><span class="v_middle">*</span> 장바구니에 담긴 상품은 3일동안 보관됩니다</p>
                </div>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th>상품정보</th>
                      <th>판매가격</th>
                      <th>수량</th>
                      <th>합계</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="info clearfix" style="width:400px;">
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
                        <input type="text" name="select_amount" id="amount_val" value="1">
                        <span class="amount_btn">
                          <img src="<?=$_mnv_PC_images_url?>polygon_double.png" usemap="#amount">
                          <map name="amount" id="amount">
                            <area shape="rect" coords="0,0,9,9" href="#" onclick="amount_change('up');return false;";>
                            <area shape="rect" coords="0,10,9,19" href="#" onclick="amount_change('down');return false;";>
                          </map>
                        </span>
                      </td>
                      <td class="total">20,000</td>
                      <td style="padding-right:15px;">
                        <input type="button" value="위시리스트 담기" class="board_btn">
                      </td>
                    </tr>
                    <!-- 장바구니 담은 상품 없을때 -->
<!--
                    <tr style="height:120px;">
                      <td colspan="5">주문내역이 없습니다.</td>
                    </tr>
-->
                    <!-- 장바구니 담은 상품 없을때 -->
                  </tbody>
                </table>
              </div>
              <div class="block_btn clearfix mt15">
                <div class="lt_float">
                  <input type="button" value="모두삭제" class="button_custom">
                  <input type="button" value="선택상품삭제" class="button_custom">
                </div>
              </div>
              <div><!-- 장바구니 담은 상품 없을때 -->
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
                </div><!-- 장바구니 담은 상품 없을때 -->
                <div class="block_btn mt40">
                  <input type="button" class="button_default mr10" value="계속 쇼핑하기">
                  <input type="button" class="button_default onColor" value="주문하기">
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
