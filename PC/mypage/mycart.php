<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
/*
	if (!$_SESSION['ss_chon_id'])
	{
		echo "<script>alert('로그인 후 이용해 주세요.');</script>";
		echo "<script>location.href='".$_mnv_PC_member_url."member_login.php';</script>";
	}
*/
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
                <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span class="active_underLine">장바구니</span></a>
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
                      <th style="width:40px;">
                        <div class="checks">
                          <input type="checkbox" id="chk_all">
                          <label for="chk_all"></label>
                        </div>
                      </th>
                      <th style="width:430px;">상품정보</th>
                      <th style="width:80px;">판매가격</th>
                      <th style="width:100px;">수량</th>
                      <th style="width:120px;">합계</th>
                      <th style="width:120px;"></th>
                    </tr>
                  </thead>
                  <tbody>
<?
	if ($_SESSION['ss_chon_id'])
		$cart_id	= $_SESSION['ss_chon_id'];
	else
		$cart_id	= $_SESSION['ss_chon_cartid'];

	$cart_query		= "SELECT A.goods_option, A.goods_cnt, A.idx cart_idx,B.* FROM ".$_gl['mycart_info_table']." AS A INNER JOIN ".$_gl['goods_info_table']." AS B ON A.goods_idx=B.idx WHERE A.cart_regdate >= date_add(now(), interval -3 day) AND A.mb_id='".$cart_id."' AND A.showYN='Y'";
	$cart_result		= mysqli_query($my_db, $cart_query);
	$cart_num		= mysqli_num_rows($cart_result);

	if ($cart_num > 0)
	{
		$total_price	= 0;
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
			foreach($goods_option_arr as $key => $val)
			{
				$sub_option_arr		= explode("|+|",$val);
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
                      <td>
                        <div class="checks">
                          <input type="checkbox" id="<?=$cart_data['cart_idx']?>_ex_chk" name="chk">
                          <label for="<?=$cart_data['cart_idx']?>_ex_chk"></label>
                        </div>
                      </td>
                      <td class="info clearfix">
                        <div class="info_img">
                          <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$cart_data['goods_code']?>"><img src="<?=$cart_data['goods_img_url']?>" alt="<?=$cart_data['goods_name']?>" width="74px"></a>
                        </div>
                        <div class="info_txt">
                          <h3><a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$cart_data['goods_code']?>"><?=$cart_data['goods_name']?></a></h3>
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
                      <td class="price"><?=number_format($current_price)?></td>
                      <td class="count">
                        <input type="hidden" id="<?=$cart_data['cart_idx']?>_current_price" value="<?=$current_price?>">
                        <!-- <input type="hidden" id="<?=$cart_data['goods_code']?>_current__total_price" value="<?=$current_price?>"> -->
                        <input type="text" name="select_amount" id="<?=$cart_data['cart_idx']?>_cnt" class="buy_cnt" value="<?=$cart_data['goods_cnt']?>">
                        <span class="amount_btn">
                          <img src="<?=$_mnv_PC_images_url?>polygon_double.png" usemap="#amount_<?=$cart_data['cart_idx']?>">
                          <map name="amount_<?=$cart_data['cart_idx']?>" id="amount_<?=$cart_data['cart_idx']?>">
                            <area shape="rect" coords="0,0,9,9" href="#" onclick="cart_plus('<?=$cart_data['cart_idx']?>');return false;">
                            <area shape="rect" coords="0,10,9,19" href="#" onclick="cart_minus('<?=$cart_data['cart_idx']?>');return false;">
                          </map>
                        </span>
                      </td>
                      <td class="total" id="<?=$cart_data['cart_idx']?>_total_price"><?=number_format($current_sum_price)?></td>
                      <td style="padding-right:15px;">
                        <input type="button" value="관심상품 담기" class="board_btn move_wishlist" cart_idx="<?=$cart_data['cart_idx']?>" >
                      </td>
                    </tr>
<?
		}
		if ($total_price > 49999)
			$site_option['default_delivery_price']	= 0;
		$total_pay_price	= $total_price + $site_option['default_delivery_price'];

	}else{
?>
                    <!-- 장바구니 담은 상품 없을때 -->
                    <tr style="height:120px;">
                      <td colspan="6">상품이 없습니다.</td>
                    </tr>
                    <!-- 장바구니 담은 상품 없을때 -->
<?
	}
?>
                  </tbody>
                </table>
              </div>
              <div class="block_btn clearfix mt15">
                <div class="lt_float">
                  <input type="button" value="모두삭제" class="button_custom" id="all_chk_del" data-direction="cart">
                  <input type="button" value="선택상품삭제" class="button_custom" id="one_chk_del" data-direction="cart">
                </div>
              </div>
              <div><!-- 장바구니 담은 상품 없을때 -->
                <input type="hidden" id="hidden_total_price" value="<?=$total_price?>">
                <input type="hidden" id="hidden_delivery_price" value="<?=$site_option['default_delivery_price']?>">
                <input type="hidden" id="hidden_total_pay_price" value="<?=$total_pay_price?>">
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
                </div><!-- 장바구니 담은 상품 없을때 -->
                <div class="block_btn mt40">
                  <a href="<?=$_mnv_PC_url?>index.php"><input type="button" class="button_default mr10" value="계속 쇼핑하기"></a>
                  <a href="<?=$_mnv_PC_order_url?>order.php?ordertype=cart"><input type="button" class="button_default onColor" value="주문하기"></a>
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