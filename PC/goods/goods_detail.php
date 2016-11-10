<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$login_id = $_SESSION['ss_chon_id'];

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

	if ($goods_info['salesYN'] == "N")
		$current_cnt	= 0;

?>
  <body>
<input type="hidden" id="hd_sales_price" value="<?=$real_price?>">
<input type="hidden" id="goods_idx" value="<?=$goods_info['idx']?>">
<input type="hidden" id="goods_optionYN" value="<?=$goods_info['goods_optionYN']?>">
<input type="hidden" id="goods_current_cnt" value="<?=$current_cnt?>">

    <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
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
                      <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$goods_info['cate_1']?>"><span class="cate1"><?=$cate1?></span></a>
                        <span>></span>
                      <a href="<?=$_mnv_PC_goods_url?>goods_list.php?cate_no=<?=$goods_info['cate_1']?>&sub_cate_no=<?=$goods_info['cate_2']?>"><span class="cate2 current_cate"><?=$cate2?></span></a>
                    </div>
                    <div class="block_line">
                      <span class="product_name left_text"><?=$goods_info['goods_name']?></span>
<?
	if ($goods_info['goods_new_flag'] == "Y")
	{
?>
                      <span class="stt_icon1 new">new</span>
<?
	}
	if ($goods_info['goods_best_flag'] == "Y")
	{
?>
                      <span class="stt_icon1 best">best</span>
<?
	}
	if ($goods_info['goods_restock_flag'] == "Y")
	{
?>
                      <span class="stt_icon1 restock">재입고</span>
<?
	}
?>
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
                      <span class="price"><?=number_format($goods_info['sales_price'])?>원</span>
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
                      <input type="text" name="select_amount" id="buy_cnt" class="buy_cnt" value="1" readonly>
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
<?
	if ($goods_info['goods_optionYN'] == "Y")
	{
		$i	= 0;
		foreach($goods_option_arr as $key => $val)
		{
			$final_option_arr			= explode("|+|",$val);
			$final_option_sel_arr	= explode(";",$final_option_arr[1]);
?>
                    <div class="block_line">
                        <span class="left_text">
                          <?=$final_option_arr[0]?>
                        </span>
                        <div class="select_box">
                          <label for="option_change<?=$i?>" class="select_label">[필수]옵션을 선택해주세요</label>
                          <select name="select_option" id="option_change<?=$i?>" class="option_change">
                            <option value="default" selected="selected">[필수]옵션을 선택해주세요</option>
<?
			foreach($final_option_sel_arr as $key2 => $val2)
			{
?>
                            <option value="<?=$final_option_arr[0]."|+|".$val2?>"><?=$val2?></option>
<?
			}
?>
                          </select>
                        </div>
                    </div>
<?
			$i++;
		}
	}
?>
                  </div>
                  <div class="block_info_bottom">
                    <div class="block_line total clearfix">
                      <span class="left_text">총 상품금액(수량)</span>
                      <div class="right_text">
                        <span class="total_price" id="total_price"><?=number_format($real_price)?>원</span><span class="total_amount" id="total_cnt">(1개)</span>
                      </div>
                    </div>
                    <div class="block_btn clearfix">
                      <input type="button" class="pr_btn img_purchase" id="order_link">
                      <input type="button" class="pr_btn img_basket" id="mycart_link">
                      <input type="button" class="pr_btn img_wishlist" id="wish_link">
                      <!-- 장바구니 팝업 -->
                      <div class="popup_basket" style="display:none;">
                        <div class="popup_inner">
                          <div class="area_close"><a href="javascript:$('.popup_basket').hide();">닫기</a></div>
                          <div class="popup_txt">
                            <p>장바구니에 담겼습니다<br>지금 확인하시겠어요?</p>
                          </div>
                          <div class="popup_btn_block clearfix">
                            <input type="button" class="pr_btn sm img_continue_shopping" onclick="javascript:$('.popup_basket').hide();return false;">
                            <input type="button" class="pr_btn sm img_view_basket" onclick="javascript:location.href='../mypage/mycart.php';">
                          </div>
                        </div>
                      </div>
                      <!-- 장바구니 팝업 -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="area_main_middle">
              <!-- <div class="product_logo">
                <img src="../images/product_logo.png">
              </div> -->
<?=$goods_info['goods_big_desc'];?>
              <div class="product_dt_info">
                <div class="dt_info_top" style="display:none;">
                  <div class="caution_txt ceramics">
                    <h2>수작업으로 만들어진 도자기들은,</h2>
                    <p>무늬와 사이즈가 상세 설명과 차이가 있을 수 있어요.<br>
                      제작공정 과정 중 유약이 흐른 자국, 미세한 돌기, 기포 구멍 등이 발생할 수 있어요.<br>도자기 흙 또는 유약에 포함된 철 성분으로 인해 검은 점이 생성될 수 있어요.
                    </p>
                  </div>
                  <div class="caution_list clearfix">
                    <div class="caution_block">
                      <div class="caution_img">
                        <img src="../images/caution_img1.png" alt="유약 자국">
                      </div>
                      <div class="caution_ex_txt">
                        <span>유약이 흐른 자국</span>
                      </div>
                    </div>
                    <div class="caution_block">
                      <div class="caution_img">
                        <img src="../images/caution_img2.png" alt="기포 구멍">
                      </div>
                      <div class="caution_ex_txt">
                        <span>기포가 빠져나간 구멍</span>
                      </div>
                    </div>
                    <div class="caution_block">
                      <div class="caution_img">
                        <img src="../images/caution_img3.png" alt="미세 돌기">
                      </div>
                      <div class="caution_ex_txt">
                        <span>미세한 돌기</span>
                      </div>
                    </div>
                    <div class="caution_block">
                      <div class="caution_img">
                        <img src="../images/caution_img4.png" alt="철 성분 검은 점">
                      </div>
                      <div class="caution_ex_txt">
                        <span>철 성분으로 인한 검은 점</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="dt_info_bottom">
                  <div class="dt_info_bottom_bg">
                    <div class="dt_info_bottom_inner">
                      <h2 class="dt_guide_headline">
                        <img src="../images/guide_alert_ico.png" alt="주의">
                        <span>아래의 내용을 확인해주세요</span>
                      </h2>
                      <div class="dt_guide_cnts">
                        <div class="dt_guide_cnts_inner">
                          <div class="guide_block">
                            <h4><img src="../images/guide_dot_img.png">주문배송안내</h4>
                            <p><span>-</span><span>배송기간은 입금 확인일로부터 주말, 공휴일을 제외하고 약 1~3일 정도 소요됩니다.</span></p>
                            <p><span>-</span><span>5만원 미만 구매시 2,500원의 배송료가 추가됩니다.</span></p>
                            <p><span>-</span><span>제주도 및 도서 산간 지역은 별도의 추가요금이 발생할 수 있습니다.</span></p>
                            <p><span>-</span><span>상품 준비 기간에 따라 배송일자가 달라 질 수 있습니다.</span></p>
                            <p><span>-</span><span>택배 : 로젠택배   /   배송비 : 2,500원</span></p>
                          </div>
                          <div class="guide_block">
                            <h4><img src="../images/guide_dot_img.png">교환/반품안내</h4>
                            <p><span>-</span><span>상품하자, 오배송으로 인한 교환 및 반품시 상품 수령 후 7일 이내 교환처리 해드립니다.</span></p>
                            <p><span>-</span><span>단순 고객 변심에 의한 교환은 왕복 택배비 5,000원을 동봉하여 주시기 바랍니다.</span></p>
                            <p><span>-</span><span>반품은 배송비를 지불하셨다면 편도 택배비 2,500원, 무료배송 받으셨다면 왕복 택배비 5,000원을 동봉하여 주시기 바랍니다.<br>
                              (반품신청 기간은 제품을 받은 날부터 3일 이내로 신청해주셔야 반품이 가능합니다.)</span></p>
                            <p><span>-</span><span>모든 교환 및 반품은 먼저 고객센터로 교환/반품 의사를 밝혀주셔야하며, 로젠택배를 이용해 반품을 신청해주세요.</span></p>
                          </div>
                          <div class="guide_block">
                            <h4><img src="../images/guide_dot_img.png">교환/반품이 불가한 경우</h4>
                            <p><span>-</span><span>교환/반품 기간이 경과된 경우</span></p>
                            <p><span>-</span><span>교환 및 반품 의사를 동봉하지 않은 경우</span></p>
                            <p><span>-</span><span>고객의 부주의로 인해 상품이 훼손된 경우 / 사용흔적이 있거나 판매가 불가한 경우</span></p>
                            <p><span>-</span><span>이벤트 및 세일상품</span></p>
                          </div>
                          <div class="guide_block">
                            <h4><img src="../images/guide_dot_img.png">고객센터</h4>
                            <p><span>-</span><span>전화 : 070-4888-3580</span></p>
                            <p><span>-</span><span>교환 및 반품주소 : 서울특별시 서초구 방배동 931-9 2F</span></p>
                            <p><span>-</span><span>고객 상담시간 : 평일 오전 10시 30분 ~오후 5시 (토요일, 일요일 및 공휴일 휴무)
                              </span></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="product_dt_branding" style="display:none;">
                <img src="../images/branding_img.jpg">
              </div>
            </div>
            <div class="area_main_bottom">
              <div class="related_block">
                <p class="head_txt mb14">관련상품</p>
                <div class="list_product clearfix">
<?
	$related_goods_arr		= explode(";",$goods_info['related_goods']);

	foreach($related_goods_arr as $key => $val)
	{
		$related_goods_info	= select_goods_info($val);
		$related_goods_info['goods_img_url']		= str_replace("../../","../",$related_goods_info['goods_img_url']);
		if ($val != "")
		{
?>
                  <div class="product n4 rt">
                    <a href="<?=$_mnv_PC_goods_url?>goods_detail.php?goods_code=<?=$related_goods_info['goods_code']?>"><img src="<?=$related_goods_info['goods_img_url']?>"></a>
                    <div class="prd_info">
                      <span class="prd_name"><?=$related_goods_info['goods_name']?></span>
                      <span class="stt_icon2 new">NEW</span>
                      <span class="prd_price"><?=number_format($related_goods_info['sales_price'])?></span>
                      <span class="prd_desc">
                      <?=$related_goods_info['goods_small_desc']?>
                      </span>
                    </div>
                  </div>
<?
		}
	}
?>
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
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
<script>
	var cnt=1;
	jQuery(document).ready(function(){
<?
	$i	= 0;
	if(is_array($goods_option_arr)) {
		foreach($goods_option_arr as $key => $val)
		{
?>
		var select = $("select#option_change<?=$i?>");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);
		});
<?
			$i++;
		}
	}
?>
		$(".open_board").on("click", function(){
			var target = $(this).parent().parent("tr").next(".hidden_board");
			$(target).slideToggle();
			$(".hidden_board").not(target).css("display", "none");
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
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "ajax_goods_review.php",
			data:{
				"pg"	: num,
				"goods_code"	: "<?=$goods_code?>"
			},
			success: function(response){
				$("#review_board_area").html(response);
			}
		});
	}
	
	function pageRun2(num)
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "ajax_goods_qna.php",
			data:{
				"pg"	: num,
				"goods_code"	: "<?=$goods_code?>"
			},
			success: function(response){
				$("#qna_board_area").html(response);
			}
		});
	}
	
	function edit_review(user_id, idx, goodsCode)
	{
		location.href="<?=$_mnv_PC_board_url?>edit_review.php?idx="+idx+"&goods_code="+goodsCode;
	}
	
	function edit_qna(user_id, idx, goodsCode)
	{
		location.href="<?=$_mnv_PC_board_url?>edit_qna.php?idx="+idx+"&goods_code="+goodsCode;
	}

</script>
</html>