<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$user_data		= select_member_info();

	$split_email	= explode('@', $user_data['mb_email']);
	$split_birth		= explode('/', $user_data['mb_birth']);
	$split_phone	= explode('-', $user_data['mb_handphone']);
	$split_tel		= explode('-', $user_data['mb_telphone']);
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
              <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_modify.png" alt="회원정보수정"></p>
            </div>
            <div class="mypage_cate_hori">
              <a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a>
              <span class="bar1 short"></span>
              <a href="<?=$_mnv_PC_mypage_url?>wishlist.php"><span>관심상품</span></a>
              <span class="bar1 short"></span>
              <a href="<?=$_mnv_PC_mypage_url?>order_status.php"><span>주문조회</span></a>
              <span class="bar1 short"></span>
              <a href="<?=$_mnv_PC_mypage_url?>coupon.php"><span>쿠폰</span></a>
              <span class="bar1 short"></span>
              <a href="<?=$_mnv_PC_board_url?>list_mtm.php"><span>1대1 문의하기</span></a>
              <span class="bar1 short"></span>
              <a href="<?=$_mnv_PC_member_url?>modify_form.php"><span class="active_underLine">개인정보 수정</span></a>
            </div>
          </div>
          <div class="area_main_middle nopadd noborder">
            <form id="modify_form">
              <div class="block_bg">
                <div class="block_copy">
                  <div class="block_line clearfix">
                    <span class="input_guide">아이디<span class="fontColor">*</span></span>
                    <div class="input_block">
                      <input type="text" class="inputT" id="user_id" name="user_id" value="<?=$user_data['mb_id']?>" disabled>
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">비밀번호<span class="fontColor">*</span></span>
                    <div class="input_block">
                      <input type="password" class="inputT" id="password" name="password">
                      <span>(영문대소문자/숫자/특수문자 6 - 12자)</span>
                    </div>
                  </div>
                  <div class="block_line clearfix pb20">
                    <span class="input_guide">비밀번호확인<span class="fontColor">*</span></span>
                    <div class="input_block">
                      <input type="password" class="inputT" id="passchk" onblur="pass_chk(this.value);return false;">
                      <span id="check_alert2" style="color:#b88b5b;letter-spacing:-1px;"></span>
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">이름<span class="fontColor">*</span></span>
                    <div class="input_block"><input type="text" class="inputT" id="username" name="username" value="<?=$user_data['mb_name']?>" style="ime-mode:active"></div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">휴대전화<span class="fontColor">*</span></span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="4" id="phone1" name="phone1" value="<?=$split_phone[0]?>">
                      <span class="mrl1">-</span>
                      <input type="text" class="inputT" size="4" id="phone2" name="phone2" value="<?=$split_phone[1]?>">
                      <span class="mrl1">-</span>
                      <input type="text" class="inputT" size="4" id="phone3" name="phone3" value="<?=$split_phone[2]?>">
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">일반전화</span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="4" id="tel1" name="tel1" value="<?=$split_tel[0]?>">
                      <span class="mrl1">-</span>
                      <input type="text" class="inputT" size="4" id="tel2" name="tel2" value="<?=$split_tel[1]?>">
                      <span class="mrl1">-</span>
                      <input type="text" class="inputT" size="4" id="tel3" name="tel3" value="<?=$split_tel[2]?>">
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">주소</span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="7" name="zipcode" id="zipcode" value="<?=$user_data['mb_zipcode']?>" readonly="true">
                      <input type="button" class="board_btn" id="find_addr" value="주소검색">
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide blind">주소2</span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="70" name="addr1" id="addr1" value="<?=$user_data['mb_address1']?>" readonly="true"><span>기본주소</span>
                    </div>
                  </div>
                  <div class="block_line clearfix pb20 addr">
                    <span class="input_guide blind">주소3</span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="70" name="addr2" id="addr2" value="<?=$user_data['mb_address2']?>"><span>나머지주소(직접입력)</span>
                      <p>미리 입력해두면 주문/배송시 더 간편해집니다.</p>
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">이메일<span class="fontColor">*</span></span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="15" id="email1" name="email1" value="<?=$split_email[0]?>">
                      <span class="fontColor mrl1" style="font-size:15px;">@</span>
                      <input type="text" class="inputT" size="15" id="email2" name="email2" value="<?=$split_email[1]?>">
                      <div class="selectbox email">
                        <label for="email3">직접입력</label>
                        <select id="email3" name="email3">
                          <option value="direct" selected>직접입력</option>
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
                    </div>
                  </div>
                  <div class="block_line clearfix" style="height:42px;">
                    <span class="input_guide" style="line-height:normal;">이메일<br>수신여부<span class="fontColor">*</span></span>
                    <div class="input_block" style="line-height:normal;">
                      <span class="rd_txt">수신함</span><input type="radio" name="emailYN" value="Y" <? if($user_data['mb_emailYN'] == 'Y') echo 'checked'; ?>><span class="rd_txt">수신안함</span><input type="radio" name="emailYN" value="N" <? if($user_data['mb_emailYN'] == 'N') echo 'checked'; ?>>
                      <p>쇼핑몰에서 제공하는 제품 및 이벤트 소식을 이메일로 받으실 수 있어요.</p>
                    </div>
                  </div>
                  <div class="block_line clearfix" style="height:42px;">
                    <span class="input_guide" style="line-height:normal;">문자<br>수신여부<span class="fontColor">*</span></span>
                    <div class="input_block" style="line-height:normal;">
                      <span class="rd_txt">수신함</span><input type="radio" name="smsYN" <? if($user_data['mb_smsYN'] == 'Y') echo 'checked'; ?> value="Y"><span class="rd_txt">수신안함</span><input type="radio" name="smsYN" <? if($user_data['mb_smsYN'] == 'N') echo 'checked'; ?> value="N">
                      <p>임시 텍스트영역</p>
                    </div>
                  </div>
                  <div class="block_line clearfix">
                    <span class="input_guide">생년월일</span>
                    <div class="input_block">
                      <input type="text" class="inputT" size="7" name="birthY" id="birthY" value="<?=$split_birth[0]?>">
                      <input type="text" class="inputT" size="7" name="birthM" id="birthM" value="<?=$split_birth[1]?>">
                      <input type="text" class="inputT" size="7" name="birthD" id="birthD" value="<?=$split_birth[2]?>">
                      <p>생일에 특별한 쿠폰을 드립니다</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="block_btn mt30">
                <input type="button" class="button_default onColor" id="submit" value="수정완료">
                <input type="button" class="button_default" id="cancel_modify_member" value="수정취소">
              </div>
            </form>
          </div>
          <div class="area_main_bottom">

          </div>
        </div>
        <div class="section side">
          <div class="side_full_img">
            <img src="<?=$_mnv_PC_images_url?>side_full.jpg">
          </div>
        </div>
      </div>
    </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </div>

<script type="text/javascript">
	$(window).load(function() {
		if($('#birthY').val() !== ''){
			$('#birthY').attr('disabled', 'true');
			$('#birthM').attr('disabled', 'true');
			$('#birthD').attr('disabled', 'true');
		}
	});
	
	$('#find_addr').on('click', function() {
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
				document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
				document.getElementById('addr1').value = fullAddr;

				// 커서를 상세주소 필드로 이동한다.
				document.getElementById('addr2').focus();
			}
		}).open();
	});

	$(document).ready(function() {
		var select = $("select#email3");

		select.change(function(){
			var select_name = $(this).children("option:selected").text();
			$(this).siblings("label").text(select_name);

			$('#email2').attr('disabled', false);
			var mail = $('#email3').val();
			if(mail=="direct") {
				$('#email2').val('').focus();
			}else{
				$('#email2').val('').val(mail);
				$('#email2').attr('disabled', true);
			}
		});
	});


	$('#submit').on('click', function(){
		var val_check = validate('modify');
		if(val_check){
			$.ajax({
				method: 'POST',
				url: '../../main_exec.php',
				data: {
					exec        : "member_modify",
					user_id     : user_id.value,
					password    : password.value,
					username    : username.value,
					zipcode     : zipcode.value,
					addr1       : addr1.value,
					addr2       : addr2.value,
					email1      : email1.value,
					email2      : email2.value,
					emailYN     : $(':radio[name="emailYN"]:checked').val(),
					tel1        : tel1.value,
					tel2        : tel2.value,
					tel3        : tel3.value,
					phone1      : phone1.value,
					phone2      : phone2.value,
					phone3      : phone3.value,
					smsYN       : $(':radio[name="smsYN"]:checked').val(),
					birthY      : $('#birthY').val(),
					birthM      : $('#birthM').val(),
					birthD      : $('#birthD').val()
				},
				success: function(res){
					if(res=='Y'){
						alert("개인정보를 수정 하였습니다.");
						//자동 로그아웃?
//						location.href='./member_login.php';
						history.back();
					}else{
						alert("수정 실패");
					}
				}
			});
		}
	});

	function pass_chk(input) {
		var pass = $('#password').val();
		if(input != pass){
			$('#check_alert2').text("비밀번호가 맞지 않습니다.");
		}else if(input == ''){
			$('#check_alert2').text("비밀번호를 입력해주세요.");
		}else{
			$('#check_alert2').text('');
		}
	}

	$(document).on("click", "#cancel_modify_member", function(){
		history.back();
	});
</script>
</body>
</html>

