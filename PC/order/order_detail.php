<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$OID	= $_REQUEST['oid'];
	if (!$_SESSION['ss_chon_id'])
	{
		echo "<script>alert('로그인 후 이용해 주세요.');</script>";
		echo "<script>location.href='".$_mnv_PC_member_url."member_login.php';</script>";
	}

	// 주문번호를 이용하여 ORDER 정보 불러오기
	$order_info	= select_order_info($OID);

	// 주문번호를 이용하여 PAYMENT 정보 불러오기
	$payment_info	= select_payment_info($OID);

	// 주문 날짜
	$order_date_arr	= explode(" ",$order_info['order_regdate']);
	$order_date		= $order_date_arr[0];

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
                      <td><p><?=$order_date?></p></td>
                      <td>
                        <p class="orderNum"><?=$order_info['order_oid']?></p>
                        <input type="button" class="board_btn cancel" value="주문취소">
                      </td>
                      <td class="alignL pl30">
                        <p><?=$payment_info['LGD_PRODUCTINFO']?></p>
                      </td>
                      <td><p class="bold"><?=number_format($payment_info['LGD_AMOUNT'])?></p></td>
                      <td>
                        <p><?=$_gl['order_status'][$order_info['order_status']]?></p>
                        <!-- <p>로젠택배 [23456]</p> -->
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
<?
	$cart_idx_arr	= explode("||",$order_info['cart_idx']);
	$i = 0;
	$total_price	= 0;
	foreach($cart_idx_arr as $key => $val)
	{
		if ($i == 0)
		{
			$i++;
			continue;
		}
		$cart_query		= "SELECT A.goods_option, A.goods_cnt, A.idx cart_idx,B.* FROM ".$_gl['mycart_info_table']." AS A INNER JOIN ".$_gl['goods_info_table']." AS B ON A.goods_idx=B.idx WHERE A.idx='".$val."'";
		$cart_result		= mysqli_query($my_db, $cart_query);
		while ($cart_data = mysqli_fetch_array($cart_result))
		{
			$cart_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$cart_data['goods_img_url']);

			if ($cart_data['discount_price'] == 0)
			{
				$current_price			= $cart_data['sales_price'];
				$current_sum_price		= $cart_data['sales_price'] * $cart_data['goods_cnt'];
			}else{
				$current_price			= $cart_data['discount_price'];
				$current_sum_price		= $cart_data['discount_price'] * $cart_data['goods_cnt'];
			}

			$total_price			= $total_price + $current_sum_price;

			$goods_option_arr	= explode("||",$cart_data['goods_option']);
			$goods_option_txt	= "";
			$i = 0;
			foreach($goods_option_arr as $key2 => $val2)
			{
				$sub_option_arr		= explode("|+|",$val2);
				if ($i == 0)
					$comma	= "";
				else if ($i == count($goods_option_arr)-1)
					$comma	= "";
				else
					$comma	= ",";
				$goods_option_txt	.= $sub_option_arr[1].$comma;
				$i++;
			}
?>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="<?=$cart_data['goods_img_url']?>" alt="<?=$cart_data['goods_name']?>">
                        </div>
                        <div class="info_txt">
                          <h3><?=$cart_data['goods_name']?></h3>
<?
	if ($cart_data['goods_optionYN'] == "Y")
	{
?>
                          <p class="option">ㄴ [옵션 : <?=$goods_option_txt?>]</p>
<?
	}
?>
                        </div>
                      </td>
                      <td class="price"><?=$current_price?></td>
                      <td class="count">
                        <p><?=$cart_data['goods_cnt']?></p>
                      </td>
                      <td class="total"><?=$current_sum_price?></td>
                    </tr>
<?
		}
		if ($total_price > 49999)
			$site_option['default_delivery_price']	= 0;
		$total_pay_price	= $total_price + $site_option['default_delivery_price'];
		$i++;
	}
?>

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
                    <p><?=$order_info['order_oid']?></p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문하신분</p>
                  </div>
                  <div class="block_col">
                    <p><?=$order_info['order_name']?></p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>휴대폰</p>
                  </div>
                  <div class="block_col">
                    <p><?=$order_info['order_phone']?></p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제방법</p>
                  </div>
                  <div class="block_col">
                    <p><?=$_gl['PAYTYPE'][$payment_info['LGD_PAYTYPE']]?></p>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>결제금액</p>
                  </div>
                  <div class="block_col">
                    <p><?=number_format($payment_info['LGD_AMOUNT'])?>원</p>
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
                      <p><?=$order_info['deliver_name']?></p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>주소</p>
                    </div>
                    <div class="block_col">
                      <p>[<?=$order_info['deliver_zipcode']?>] <?=$order_info['deliver_address1']." ".$order_info['deliver_address2']?></p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>휴대폰</p>
                    </div>
                    <div class="block_col">
                      <p><?=$order_info['deliver_phone']?></p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>배송메시지</p>
                    </div>
                    <div class="block_col">
                      <p><?=$order_info['deliver_message']?></p>
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
                    <h3 class="total_order"><?=number_format($total_price)?>원</h3>
                  </div>
                  <div class="charImg">
                    <img src="<?=$_mnv_PC_images_url?>spec_plus.png">
                  </div>
                  <div class="price_block">
                    <h3>배송비</h3>
                    <h3 class="shipping"><?=number_format($site_option['default_delivery_price'])?>원</h3>
                  </div>
                  <div class="charImg">
                    <img src="<?=$_mnv_PC_images_url?>spec_equal.png">
                  </div>
                  <div class="price_block">
                    <h3>총 결제금액</h3>
                    <h3 class="total_payment"><?=number_format($total_pay_price)?>원</h3>
                  </div>
                </div>
              </div>
              <div class="block_btn mt30">
                <a href="<?=$_mnv_PC_mypage_url?>order_status.php"><input type="button" value="주문목록" class="button_default"></a>
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
