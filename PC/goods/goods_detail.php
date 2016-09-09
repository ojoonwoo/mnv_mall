<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$goods_code	= $_REQUEST['goods_code'];
	// 상품 정보
	$goods_info	= select_goods_info($goods_code);
	// 카테고리 1 정보 가져오기 ( goods_info.cate_1 )
	$cate1			= select_cate1_info($goods_info['cate_1']);
	// 카테고리 2 정보 가져오기 ( goods_info.cate_1, goods_info.cate_2 )
	$cate2			= select_cate2_info($goods_info['cate_1'],$goods_info['cate_2']);
	// 할인가 퍼센테이지 구하기
	$percent_num	= ceil(100 - (($goods_info['discount_price'] / $goods_info['sales_price'])*100));
	// 실제 상품금액 가져오기
	if ($goods_info['discount_price'] == 0)
		$real_price	= $goods_info['sales_price'];
	else
		$real_price	= $goods_info['discount_price'];

	// 현재 남은 갯수
	$current_cnt	= $goods_info['goods_stock'] - $goods_info['goods_sales_cnt'];

	$goods_info['goods_img_url']		= str_replace("../../","../",$goods_info['goods_img_url']);
	$current_cnt	= $goods_info['goods_stock'] - $goods_info['goods_sales_cnt'];
	if ($goods_info['goods_optionYN'] == "Y")
	{
		$goods_option_arr	= explode("||",$goods_info['goods_option_txt']);
	}

?>
  <body>
<input type="hidden" id="hd_sales_price" value="<?=$real_price?>">
<input type="hidden" id="goods_idx" value="<?=$goods_info['idx']?>">
    <div id="wrap_page">
      <div id="header">
        <div class="area_top">
          <div class="head_bar clearfix">
            <ul class="user_status">
<?
	if ($_SESSION['ss_chon_id'])
	{
?>
              <li><a href="#" id="mb_logout"><span>로그아웃</span></a></li>
              <li><a href="http://localhost/mnv_mall/PC/member/modify_form.php"><span>정보수정</span></a></li>
<?
	}else{
?>
              <li><a href="http://localhost/mnv_mall/PC/member/member_login.php"><span>로그인</span></a></li>
              <li><a href="http://localhost/mnv_mall/PC/member/join_form.php"><span>회원가입</span></a></li>
<?
	}
?>
              <li><a href="#"><span>마이페이지</span></a></li>
              <li><a href="#"><span>장바구니</span></a></li>
              <li><a href="#"><span>주문조회</span></a></li>
            </ul>
          </div>
        </div>
        <div class="logo_area">
          <a href="<?=$_mnv_PC_url?>index.php"><img src="../images/logo.jpg"></a>
        </div>
        <div class="area_nav">
          <div class="nav clearfix">
<?
	// 상단 카테고리 영역
	include_once $_mnv_PC_dir."cate_navi.php";
?>
          </div>
        </div>
      </div>
      <div id="wrap_content">
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="area_main_top">
              <div class="area_product_detail clearfix">
                <div class="product_head img">
                  <!-- 제품 이미지 -->
                  <img src="<?=$goods_info['goods_img_url']?>">
                </div>
                <div class="product_head info">
                  <div class="block_info_top">
                    <div class="block_line cate">
                        <span class="cate1"><?=$cate1?></span>
                        <span>></span>
                        <span class="cate2 current_cate"><?=$cate2?></span>
                    </div>
                    <div class="block_line">
                      <span class="product_name left_text"><?=$goods_info['goods_name']?></span>
                      <span class="stt_icon1 new">new</span>
                      <span class="stt_icon1 best">best</span>
                      <span class="stt_icon1 restock">재입고</span>
                    </div>
                    <div class="block_line">
                      <span class="left_text">판매가</span>
<?
	if ($goods_info['discount_price'])
	{
?>
                      <span class="price sale"><?=number_format($goods_info['sales_price'])?>원</span>
                      <span class="sale_price"><?=number_format($goods_info['discount_price'])?>원</span>
                      <span class="sale_pctg">[<?=$percent_num?>%]</span>
<?
	}else{
?>
                      <span class="price"><?=$goods_info['sales_price']?>원</span>
<?
	}
?>
                    </div>
                    <div class="block_line">
                      <span class="left_text">상품요약</span>
                      <span class="desc"><?=$goods_info['goods_small_desc']?></span>
                    </div>
                    <div class="block_line">
                      <span class="left_text">코드</span>
                      <span class="code"><?=$goods_info['goods_code']?></span>
                    </div>
                    <div class="block_line">
                      <span class="left_text">수량</span>
<?
	if ($current_cnt < 1)
	{
?>
                      <input type="text" name="select_amount" id="buy_cnt" value="품 절" readonly>
                      <!-- 품절일시 화살표 아이콘 재입고요청 버튼으로 변경-->
                      <span class="amount_btn off_stock" style="cursor:pointer;">
                        재입고요청<span class="restock_arrow"></span>
                      </span>
                      <!-- 품절일시 화살표 아이콘 재입고요청 버튼으로 변경-->
<?
	}else{
?>
                      <input type="text" name="select_amount" id="buy_cnt" value="1">
                      <span class="amount_btn">
                        <img src="../images/polygon_double.png" usemap="#amount">
                        <map name="amount" id="amount">
                          <area shape="rect" coords="0,0,9,9" href="#" id="cnt_plus">
                          <area shape="rect" coords="0,10,9,19" href="#" id="cnt_minus">
                        </map>
                      </span>
<?
	}
?>

                    </div>
                    <div class="block_line">
<?
	if ($goods_info['goods_optionYN'] == "Y")
	{
		foreach($goods_option_arr as $key => $val)
		{
			$final_option_arr			= explode("|+|",$val);
			$final_option__sel_arr	= explode(";",$final_option_arr[1]);
?>
                        <span class="left_text">
                          <?=$final_option_arr[0]?>
                        </span>
                        <div class="select_box">
                          <label for="option_change" class="select_label">[필수]옵션을 선택해주세요</label>
                          <select name="select_option" id="option_change">
                            <option value="default" selected="selected">[필수]옵션을 선택해주세요</option>
<?
			foreach($final_option__sel_arr as $key2 => $val2)
			{
?>
    <option><?=$val2?></option>
<?
			}
?>
                          </select>
                        </div>
<?
		}
	}
?>
                    </div>
                  </div>
                  <div class="block_info_bottom">
                    <div class="block_line total clearfix">
                      <span class="left_text">총 상품금액(수량)</span>
                      <div class="right_text">
                        <span class="total_price" id="total_price"><?=number_format($real_price)?>원</span><span class="total_amount" id="total_cnt">(1개)</span>
                      </div>
                    </div>
                    <div class="block_btn clearfix">
                      <input type="button" class="pr_btn active" value="바로구매">
                      <input type="button" class="pr_btn" value="장바구니" id="mycart_link">
                      <input type="button" class="pr_btn" value="위시리스트" id="wish_link">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="area_main_middle">
              <div class="product_logo">
                <img src="../images/product_logo.png">
              </div>
<?=$goods_info['goods_big_desc'];?>
              <div class="product_dt_info">
                <img src="../images/detail_info.jpg">
              </div>
              <div class="product_dt_branding">
                <img src="../images/branding_img.jpg">
              </div>
            </div>
            <div class="area_main_bottom">
              <div class="related_block">
                <p class="head_txt mb14">관련상품</p>
                <div class="list_product clearfix">
                  <div class="product n4 rt">
                    <a href="#"><img src="../images/relate1.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">에디슨 스탠드 조명</span>
                      <span class="stt_icon2 new">NEW</span>
                      <span class="prd_price">2,500원</span>
                      <span class="prd_desc">
                      디저트접시로, 앞접시로,<br>
                      반찬접시로 전천후로 활용가능한<br>
                      접시에요.<br>
                      테두리에 홈이 파진 모양새가<br>
                      단조롭지 않고 귀엽답니다!
                      </span>
                    </div>
                  </div>
                  <div class="product n4 rt">
                    <a href="#"><img src="../images/relate2.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">에디슨 스탠드 조명</span>
                      <span class="stt_icon2 restock">재입고</span>
                      <span class="prd_price">2,500원</span>
                      <span class="prd_desc">
                        디저트접시로, 앞접시로,<br>
                        반찬접시로 전천후로 활용가능한<br>
                        접시에요.<br>
                        테두리에 홈이 파진 모양새가<br>
                        단조롭지 않고 귀엽답니다!
                      </span>
                    </div>
                  </div>
                  <div class="product n4 rt">
                    <a href="#"><img src="../images/relate3.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">에디슨 스탠드 조명</span>
                      <span class="stt_icon2 best">BEST</span>
                      <span class="prd_price">2,500원</span>
                      <span class="prd_desc">
                        디저트접시로, 앞접시로,<br>
                        반찬접시로 전천후로 활용가능한<br>
                        접시에요.<br>
                        테두리에 홈이 파진 모양새가<br>
                        단조롭지 않고 귀엽답니다!
                      </span>
                    </div>
                  </div>
                  <div class="product n4 rt">
                    <a href="#"><img src="../images/relate4.jpg"></a>
                    <div class="prd_info">
                      <span class="prd_name">에디슨 스탠드 조명</span>
                      <span class="stt_icon2 best">BEST</span>
                      <span class="prd_price">2,500원</span>
                      <span class="prd_desc">
                        디저트접시로, 앞접시로,<br>
                        반찬접시로 전천후로 활용가능한<br>
                        접시에요.<br>
                        테두리에 홈이 파진 모양새가<br>
                        단조롭지 않고 귀엽답니다!
                      </span>
                    </div>
                  </div>
                </div>
              </div>
<?
	// 리뷰 영역
	include_once $_mnv_PC_goods_dir."goods_review.php";
	// 상품 문의 영역
	include_once $_mnv_PC_goods_dir."goods_qna.php";
?>
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="../images/side_full_img1.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC">고객센터</span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon">ABOUT 촌의감각</span></a>
              <a href="#"><span class="sugg">입점문의</span></a>
              <a href="#"><span class="sugg">제휴문의</span></a>
              <a href="#"><span class="sugg last">대량구매</span></a>
            </div>
            <div class="box_info sns clearfix">
              <a href="#"><span>인스타그램</span></a>
              <a href="#"><span>페이스북</span></a>
              <a href="#"><span>블로그</span></a>
            </div>
          </div>
        </div>
        <div class="address">
          <p>company  미니버타이징(주)  address  서울특별시  서초구  방배동  931-9  2F</p>
          <p>owner  양선혜    business  license  114  87  11622   privacy policy | terms of use</p>
          <br>
          <p>@chon all rights reserved</p>
        </div>
      </div>
    </div>
  </body>
<script>
	var cnt=1;
	jQuery(document).ready(function(){
		var select = $("select#option_change");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});
	});

	function amount_change(type) {
		var amount = $('#amount_val');
		if(type=='up'){
			cnt = cnt+1;
			$('#amount_val').val(cnt);
		}else if(type=='down' && cnt>1){
			cnt = cnt-1;
			$('#amount_val').val(cnt);
		}else{
			cnt = 1;
		}
	}

	function pageRun(num)
	{
		$('#review_board_area').load(function(){
			f = document.frm_execute;
			f.pg.value = num;
			f.submit();
		}).fadeIn("slow");
	}

</script>
</html>