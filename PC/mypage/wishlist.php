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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_wishlist.png" alt="관심상품"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_url?>wishlist.php"><span class="active_underLine">관심상품</span></a>
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
            <div class="area_main_middle nopadd">
              <div class="table_block wish">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th style="width:40px;">
                        <div class="checks">
                          <input type="checkbox" id="chk_all">
                          <label for="chk_all"></label>
                        </div>
                      </th>
                      <th style="width:370px;">상품정보</th>
                      <th style="width:250px;">판매가격</th>
                      <th style="width:230px;"></th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$wish_query		= "SELECT A.goods_option, A.idx wish_idx, B.* FROM ".$_gl['wishlist_info_table']." AS A INNER JOIN ".$_gl['goods_info_table']." AS B ON A.goods_idx=B.idx WHERE A.mb_id='".$_SESSION['ss_chon_id']."' AND A.showYN='Y'";
	$wish_result		= mysqli_query($my_db, $wish_query);
	$wish_num		= mysqli_num_rows($wish_result);
	if ($wish_num > 0)
	{
		$total_price	= 0;
		while ($wish_data = mysqli_fetch_array($wish_result))
		{
			$wish_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$wish_data['goods_img_url']);

			if ($wish_data['discount_price'] == 0)
				$current_price	= $wish_data['sales_price'];
			else
				$current_price	= $wish_data['discount_price'];

			$goods_option_arr	= explode("||",$wish_data['goods_option']);
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
                      <!-- <input type="hidden" id="goods_idx" value="<?=$wish_data['idx']?>">
                      <input type="hidden" id="wish_idx" value="<?=$wish_data['wish_idx']?>"> -->
                      <td>
                        <div class="checks">
                          <input type="checkbox" id="<?=$wish_data['wish_idx']?>_ex_chk" name="chk">
                          <label for="<?=$wish_data['wish_idx']?>_ex_chk"></label>
                        </div>
                      </td>
                      <td class="info clearfix">
                        <div class="info_img">
                          <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$wish_data['goods_code']?>"><img src="<?=$wish_data['goods_img_url']?>" alt="<?=$wish_data['goods_name']?>" style="width:75px"></a>
                        </div>
                        <div class="info_txt">
                          <h3><a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$wish_data['goods_code']?>"><?=$wish_data['goods_name']?></a></h3>
<?
	if ($wish_data['goods_optionYN'] == "Y")
	{
?>
                          <p class="option">ㄴ [옵션 : <?=$goods_option_txt?>]</p>
<?
	}
?>
                        </div>
                      </td>
                      <td class="price"><?=number_format($current_price)?></td>
                      <td style="padding-right:45px;text-align:right;">
                        <input type="button" value="주문하기" class="board_btn wish_order">
                        <input type="button" value="장바구니" class="board_btn white move_mycart" wish_idx="<?=$wish_data['wish_idx']?>">
                        <input type="button" value="삭제" class="board_btn white del_wishlist" wish_idx="<?=$wish_data['wish_idx']?>" goods_idx="<?=$wish_data['idx']?>">
                      </td>
                    </tr>
<?
		}
	}else{
?>
                    <!-- 장바구니 담은 상품 없을때 -->
                    <tr style="height:120px;">
                      <td colspan="5">관심상품이 없습니다.</td>
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
                  <input type="button" value="모두삭제" class="button_custom" id="all_chk_del" data-direction="wish">
                  <input type="button" value="선택상품삭제" class="button_custom" id="one_chk_del" data-direction="wish">
                </div>
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
