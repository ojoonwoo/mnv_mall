<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$ordertype	= $_REQUEST['ordertype'];

	$order_info	= select_order_goods($ordertype);

	if ($_SESSION['ss_chon_id'])
	{
		$member_info	= select_member_info();
		$mb_phone		= explode("-",$member_info['mb_handphone']);
		$mb_email		= explode("@",$member_info['mb_email']);
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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_order.png" alt="주문서"></p>
              </div>
              <div class="main_top_block clearfix">
                <!-- <div class="lt_float">
                  <input type="button" value="작성하기" class="board_btn">
                </div> -->
                <div class="rt_float">
                  <p><span class="v_middle">*</span> 상품의 옵션 및 수량 변경은 상품상세 또는 장바구니에서 가능합니다</p>
                </div>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th style="width:500px;">상품정보</th>
                      <th style="width:120px;">판매가격</th>
                      <th style="width:120px;">수량</th>
                      <th style="width:150px;">합계</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$total_price		= 0;
	$order_cart_idx	= null;
	$order_goods_cnt	= count($order_info);
	foreach($order_info as $key => $val)
	{
		$order_cart_idx	.= "||".$val['idx'];
		$goods_info	= select_idx_goods_info($val['goods_idx']);
		$goods_info['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$goods_info['goods_img_url']);

		if ($goods_info['discount_price'] == 0)
		{
			$current_price			= $goods_info['sales_price'];
			$current_sum_price		= $goods_info['sales_price'] * $val['goods_cnt'];
		}else{
			$current_price			= $goods_info['discount_price'];
			$current_sum_price		= $goods_info['discount_price'] * $val['goods_cnt'];
		}

		$total_price			= $total_price + $current_sum_price;

		$goods_option_arr	= explode("||",$val['goods_option']);
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

		$show_goods_name	= $goods_info['goods_name'];
?>
                    <tr>
                      <td class="info clearfix">
                        <div class="info_img">
                          <img src="<?=$goods_info['goods_img_url']?>" alt="<?=$goods_info['goods_name']?>">
                        </div>
                        <div class="info_txt">
                          <h3><?=$goods_info['goods_name']?></h3>
<?
	if ($goods_info['goods_optionYN'] == "Y")
	{
?>
                          <p class="option">ㄴ [옵션 : <?=$goods_option_txt?>]</p>
<?
	}
?>
                        </div>
                      </td>
                      <td class="price"><?=number_format($current_price)?></td>
                      <td class="count"><?=$val['goods_cnt']?></td>
                      <td class="total"><?=number_format($current_sum_price)?></td>
                    </tr>
<?
		if ($total_price > 49999)
			$site_option['default_delivery_price']	= 0;
		$total_pay_price	= $total_price + $site_option['default_delivery_price'];
	}

	if ($order_goods_cnt > 1)
	{
		$order_goods_cnt = $order_goods_cnt -1;
		$show_goods_name	= $show_goods_name." 외 ".$order_goods_cnt."건";
	}
?>
                    <input type="hidden" id="order_cart_idx" value="<?=$order_cart_idx?>">
                    <input type="hidden" id="total_order_price" value="<?=$total_price?>">
                    <input type="hidden" id="delivery_price" value="<?=$site_option['default_delivery_price']?>">
                    <input type="hidden" id="total_pay_price" value="<?=$total_pay_price?>">
                    <input type="hidden" id="show_goods_name" value="<?=$show_goods_name?>">
                  </tbody>
                </table>
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
              <div class="form_header clearfix">
                <div class="lt_float">
                  <h2>주문자 정보</h2>
                </div>
                <div class="rt_float">
                  <p><span class="fontColor">* </span>필수입력사항</p>
                </div>
              </div>
              <div class="table_block custom">
                <div class="block_row">
                  <div class="block_col head">
                    <p>주문하시는 분<span class="fontColor">*</span></p>
                  </div>
                  <div class="block_col">
                    <input class="inputT" type="text" size="20" id="order_name" value="<?=$member_info['mb_name']?>">
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head line3">
                    <p>주소<span class="fontColor">*</span></p>
                  </div>
                  <div class="block_col line3">
                    <input class="inputT" type="text" size="6" id="order_zipcode" value="<?=$member_info['mb_zipcode']?>">
                    <input type="button" value="우편번호" class="inputB" id="zip1"><br>
                    <input class="inputT" type="text" size="50" id="order_address1" value="<?=$member_info['mb_address1']?>"><span class="address_comment">기본주소</span><br>
                    <input class="inputT" type="text" size="50" id="order_address2" value="<?=$member_info['mb_address2']?>"><span class="address_comment">나머지주소(직접입력)</span>
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head">
                    <p>휴대전화<span class="fontColor">*</span></p>
                  </div>
                  <div class="block_col">
                    <input class="inputT" type="text" size="6" id="order_phone1" value="<?=$mb_phone[0]?>"> - <input class="inputT" type="text" size="6" id="order_phone2" value="<?=$mb_phone[1]?>"> - <input class="inputT" type="text" size="6" id="order_phone3" value="<?=$mb_phone[2]?>">
                  </div>
                </div>
                <div class="block_row">
                  <div class="block_col head line2">
                    <p>이메일<span class="fontColor">*</span></p>
                  </div>
                  <div class="block_col line2">
                    <input class="inputT" type="text" size="12" id="order_email1" value="<?=$mb_email[0]?>"><span class="fontColor atMark">@</span><input class="inputT" type="text" size="16" id="order_email2" value="<?=$mb_email[1]?>">
                    <div class="selectbox email">
                      <label for="ex_select">직접입력</label>
                      <select id="ex_select">
                        <option selected>직접입력</option>
                        <option value="naver.com">naver.com</option>
                        <option value="daum.net">daum.net</option>
                        <option value="nate.com">nate.com</option>
                        <option value="hotmail.com">hotmail.com</option>
                        <option value="yahoo.com">yahoo.com</option>
                        <option value="empas.com">empas.com</option>
                        <option value="korea.com">korea.com</option>
                        <option value="dreamwiz.com">dreamwiz.com</option>
                        <option value="gmail.com">gmail.com</option>
                      </select>
                    </div>
                    <br>
                    <p class="email_comment">
                    이메일로 주문처리과정을 보내드려요.<br>
                    반드시 수신가능한 이메일 주소를 입력해 주세요.
                    </p>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>배송지 정보</h2>
                  </div>
                  <div class="rt_float">
                    <p><span class="fontColor">* </span>필수입력사항</p>
                  </div>
                </div>
                <div class="table_block custom">
                  <div class="block_row">
                    <div class="block_col head">
                      <p>배송지선택</p>
                    </div>
                    <div class="block_col">
                      <div class="checks">
                        <label for="same_order">주문자 정보와 동일</label>
                        <input type="radio" name="select_addr_info" id="same_order">
                      </div>
                      <div class="checks">
                        <label for="new_address">새로운 배송지</label>
                        <input type="radio" name="select_addr_info" id="new_address">
                      </div>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>받으시는 분<span class="fontColor">*</span></p>
                    </div>
                    <div class="block_col">
                      <input class="inputT" type="text" size="20" id="deliver_name">
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head line3">
                      <p>주소<span class="fontColor">*</span></p>
                    </div>
                    <div class="block_col line3">
                      <input class="inputT" type="text" size="6" id="deliver_zipcode">
                      <input type="button" value="우편번호" class="inputB" id="zip2"><br>
                      <input class="inputT" type="text" size="50" id="deliver_address1"><span class="address_comment">기본주소</span><br>
                      <input class="inputT" type="text" size="50" id="deliver_address2"><span class="address_comment">나머지주소(직접입력)</span>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>휴대전화<span class="fontColor">*</span></p>
                    </div>
                    <div class="block_col">
                      <input class="inputT" type="text" size="6" id="deliver_phone1"> - <input class="inputT" type="text" size="6" id="deliver_phone2"> - <input class="inputT" type="text" size="6" id="deliver_phone3">
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head line2">
                      <p>배송메시지</p>
                    </div>
                    <div class="block_col line2">
                      <textarea name="shipping_message" class="textArea mt15" cols="70" rows="4" id="deliver_message"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>결제수단</h2>
                  </div>
                </div>
                <div class="table_block custom">
                  <div class="block_row">
                    <div class="block_col head">
                      <p>결제수단선택</p>
                    </div>
                    <div class="block_col">
                      <div class="checks">
                        <label for="card_pay">카드결제</label>
                        <input type="radio" name="select_pay" id="card_pay" value="card_pay" checked>
                      </div>
                      <div class="checks">
                        <label for="phone_pay">휴대폰결제</label>
                        <input type="radio" name="select_pay" id="phone_pay" value="phone_pay">
                      </div>
                      <div class="checks">
                        <label for="nobankbook_pay">무통장입금</label>
                        <input type="radio" name="select_pay" id="nobankbook_pay" value="nobankbook_pay">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>결제예정금액</h2>
                  </div>
                </div>
                <div class="table_block custom">
                  <div class="block_row">
                    <div class="block_col head">
                      <p>총 주문금액</p>
                    </div>
                    <div class="block_col">
                      <p><?=number_format($total_price)?></p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>배송비</p>
                    </div>
                    <div class="block_col">
                      <p><?=number_format($site_option['default_delivery_price'])?></p>
                    </div>
                  </div>
                  <div class="block_row">
                    <div class="block_col head">
                      <p>총 결제금액</p>
                    </div>
                    <div class="block_col">
                      <p><?=number_format($total_pay_price)?></p>
                    </div>
                  </div>
                </div>
                <div class="form_header clearfix">
                  <div class="lt_float">
                    <h2>이용안내</h2>
                  </div>
                </div>
                <div class="guide_list">
                  <div class="guide_inner">
                    <div class="guide_block">
                      <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>Window XP 서브시팩2를 설치하신 후 결제가 정상적인 단계로 처리되지 않는경우, 아래의 절차에 따라 해결하시기 바랍니다.</p>
                      <p><span>-</span>안심클릭 결제모듈이 설치되지 않은 경우 ActiveX 수동설치</p>
                      <p><span>-</span>Service Pack 2에 대한 Microsoft사의 상세안내</p>
                    </div>
                     <div class="guide_block">
                       <p><span><img src="<?=$_mnv_PC_images_url?>middot.png"></span>아래의 쇼핑몰일 경우에는 모든 브라우저 사용이 가능합니다.</p>
                       <p><span>-</span>KG이니시스, KCP, LG U+를 사용하는 쇼핑몰일 경우</p>
                       <p>
                         <span>-</span>결제가능브라우저 : 크롬, 파이어폭스, 사파리, 오페라 브라우저에서 결제 가능<br>
                         &nbsp;&nbsp;&nbsp;&nbsp;(단, Window os 사용자에 한하여 리눅스/mac os 사용자는 사용불가)
                       </p>
                       <p><span>-</span>최초 결제 시도시에는 플러그인을 추가 설치 후 반드시 브라우저 종료 후 재시작해야만 결제가 가능합니다.(무통장, 휴대폰결제 포함)</p>
                    </div>
                  </div>
                </div>
                <div class="block_btn mt40">
                  <input type="button" class="button_default mr10" value="이전 페이지">
                  <input type="button" class="button_default onColor" id="pay_order" value="결제하기">
                </div>
              </div>
            </div>
            <div class="area_main_bottom">
              <img src='<?=$_mnv_PC_images_url?>blank.png'>
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
<script language='javascript' src='http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js' type='text/javascript'></script>
<script>
	$('#zip1').on('click', function() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;
				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if(data.userSelectedType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}

				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('order_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('order_address1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('order_address2').focus();
			}
		}).open();
	});

	$('#zip2').on('click', function() {
		new daum.Postcode({
			oncomplete: function(data) {
				// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
				// 각 주소의 노출 규칙에 따라 주소를 조합한다.
				// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
				var fullAddr = ''; // 최종 주소 변수
				var extraAddr = ''; // 조합형 주소 변수

				// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
				if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
					fullAddr = data.roadAddress;
				} else { // 사용자가 지번 주소를 선택했을 경우(J)
					fullAddr = data.jibunAddress;
				}

				// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
				if(data.userSelectedType === 'R'){
					//법정동명이 있을 경우 추가한다.
					if(data.bname !== ''){
						extraAddr += data.bname;
					}
					// 건물명이 있을 경우 추가한다.
					if(data.buildingName !== ''){
						extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
					}
					// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
					fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
				}

				// 우편번호와 주소 정보를 해당 필드에 넣는다.
				document.getElementById('deliver_zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('deliver_address1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('deliver_address2').focus();
			}
		}).open();
	});

</script>
</html>
