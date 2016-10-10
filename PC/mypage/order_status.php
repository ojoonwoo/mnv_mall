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
              <div class="block_title alignC mb30 mt15">
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
<?
	$order_query		= "SELECT * FROM ".$_gl['payment_info_table']." AS A INNER JOIN ".$_gl['order_info_table']." AS B ON A.LGD_OID=B.order_oid WHERE A.LGD_BUYERID='".$_SESSION['ss_chon_id']."'";
	$order_result		= mysqli_query($my_db, $order_query);
	$order_num		= mysqli_num_rows($order_result);
	if ($order_num > 0)
	{
		$total_price	= 0;
		while ($order_data = mysqli_fetch_array($order_result))
		{
			$order_date_arr	= explode(" ",$order_data['order_regdate']);
			$order_date		= $order_date_arr[0];
/*
			$wish_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$wish_data['goods_img_url']);

			if ($wish_data['discount_price'] == 0)
				$current_price	= $wish_data['sales_price'];
			else
				$current_price	= $wish_data['discount_price'];
*/
?>
                    <tr>
                      <td><p><?=$order_date?></p></td>
                      <td>
                        <a href="<?=$_mnv_PC_order_url?>order_detail.php?oid=<?=$order_data['LGD_OID']?>"><p class="orderNum"><?=$order_data['LGD_OID']?></p></a>
                        <input type="button" class="board_btn cancel" value="주문취소">
                      </td>
                      <td class="alignL pl30">
                        <a href="<?=$_mnv_PC_order_url?>order_detail.php?oid=<?=$order_data['LGD_OID']?>">
                          <p><?=$order_data['LGD_PRODUCTINFO']?></p>
<?
			$cart_idx_arr	= explode("||",$order_data['cart_idx']);

			if (count($cart_idx_arr) == 2)
			{
				$cart_idx		= $order_date_arr[1];

				$cart_query		= "SELECT goods_option FROM ".$_gl['mycart_info_table']." WHERE idx='".$cart_idx."'";
				$cart_result		= mysqli_query($my_db, $cart_query);
				$cart_data		= mysqli_fetch_array($cart_result);

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
				if ($cart_data['goods_option'] != "")
				{
?>
                          <p class="option">ㄴ [옵션 : <?=$goods_option_txt?>]</p>
<?
				}
			}
?>
                        </a>
                      </td>
                      <td><p class="bold"><?=number_format($order_data['LGD_AMOUNT'])?></p></td>
                      <td><p><?=$_gl['order_status'][$order_data['order_status']]?></p></td>
                    </tr>
<?
		}
	}else{
?>
<!-- 주문내역 없을때-->
                    <tr>
                      <td colspan="5">주문내역이 없습니다.</td>
                    </tr>
<!-- 주문내역 없을때-->

<?
	}
?>
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
