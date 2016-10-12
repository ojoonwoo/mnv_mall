<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";

	$user_data		= select_member_info();

//	$split_email	= explode('@', $user_data['mb_email']);
	$split_birth		= explode('/', $user_data['mb_birth']);
	$split_phone	= explode('-', $user_data['mb_handphone']);
	$split_tel		= explode('-', $user_data['mb_telphone']);
?>
<body>
  <div id="wrap">
<?
	// 사이트 사이드메뉴 영역
	include_once $_mnv_MOBILE_dir."aside.php";
?>
    <div class="container">
<?
	// 사이트 헤더 영역
	include_once $_mnv_MOBILE_dir."header_area.php";
?>
      <div class="contents">
        <div class="title_text">
          <h2>회원정보수정</h2>
          <p class="line"></p>
        </div>
        <div class="divideZone">
          <div class="inputBox">
            <div class="guideText">
              <p>아이디<span>*</span></p>
            </div>
            <div class="typingBox">
              <input type="text" id="user_id" name="user_id" value="<?=$user_data['mb_id']?>" disabled>
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
              <p>비밀번호<span>*</span></p>
            </div>
            <div class="typingBox">
              <input type="password" id="password" name="password">
              <p>(영문대소문자/숫자,특수문자 6~12자)</p>
            </div>
          </div>
          <div class="inputBox pb10">
            <div class="guideText">
              <p>비밀번호확인<span>*</span></p>
            </div>
            <div class="typingBox">
              <input type="password" id="passchk" onblur="pass_chk(this.value);return false;">
              <span id="check_alert2" style="color:#b88b5b;letter-spacing:-1px;"></span>
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
              <p>이름<span>*</span></p>
            </div>
            <div class="typingBox">
              <input type="text" id="username" name="username" value="<?=$user_data['mb_name']?>">
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
              <p>휴대전화<span>*</span></p>
            </div>
            <div class="typingBox n3">
              <input type="tel" id="phone1" name="phone1" value="<?=$split_phone[0]?>">
              <input type="tel" id="phone2" name="phone2" value="<?=$split_phone[1]?>">
              <input type="tel" id="phone3" name="phone3" value="<?=$split_phone[2]?>">
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
              <p>이메일<span>*</span></p>
            </div>
            <div class="typingBox">
              <input type="text" id="email" name="email" value="<?=$user_data['mb_email']?>">
              <div class="checks">
                <input type="checkbox" id="ex_chk" name="emailYN" <? if($user_data['mb_emailYN'] == 'Y') echo 'checked'; ?>>
                <label for="ex_chk">메일수신</label>
              </div>
              <p>쇼핑몰에서 제공하는 제품 및 이벤트 소식을<br/> 이메일로 받으실 수 있어요.</p>
            </div>
          </div>
        </div>
        <div class="divideZone">
          <div class="inputBox">
            <div class="guideText">
              <p>주소</p>
            </div>
            <div class="typingBox n3">
              <input type="text" id="zipcode" name="zipcode" value="<?=$user_data['mb_zipcode']?>" readonly>
              <input type="button" value="우편번호" id="find_addr" class="zipcodeBtn">
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
            </div>
            <div class="typingBox">
              <input type="text" placeholder="기본주소" name="addr1" id="addr1" value="<?=$user_data['mb_address1']?>" readonly>
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
            </div>
            <div class="typingBox">
              <input type="text" placeholder="상세주소" name="addr2" id="addr2" value="<?=$user_data['mb_address2']?>">
              <p>미리 입력해두면 주문/배송시 더 간편해집니다.</p>
            </div>
          </div>
          <div class="inputBox">
            <div class="guideText">
              <p>생년월일</p>
            </div>
            <div class="typingBox n3">
              <input type="text" name="birthY" id="birthY" value="<?=$split_birth[0]?>">
              <input type="text" name="birthM" id="birthM" value="<?=$split_birth[1]?>">
              <input type="text" name="birthD" id="birthD" value="<?=$split_birth[2]?>">
              <p>생일에 특별한 쿠폰을 드립니다</p>
            </div>
          </div>
        </div>
        <div class="halfWidthBtn whiteBgBtn pt5">
          <input type="button" value="수정완료" id="submit" class="onColor">
          <input type="button" value="취소" id="cancel_modify_member">
        </div>
      </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
    </div>
  </div>
<script type="text/javascript">
	$(window).load(function() {
		
		var emailYN = $('input:checkbox[name="emailYN"]').is(':checked');
		
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

    //		$(document).ready(function() {
    //			var select = $("select#email3");
    //
    //			select.change(function(){
    //				var select_name = $(this).children("option:selected").text();
    //				$(this).siblings("label").text(select_name);
    //
    //				$('#email2').attr('disabled', false);
    //				var mail = $('#email3').val();
    //				if(mail=="direct") {
    //					$('#email2').val('').focus();
    //				}else{
    //					$('#email2').val('').val(mail);
    //					$('#email2').attr('disabled', true);
    //				}
    //			});
    //		});


	$('#submit').on('click', function(){
		var val_check = validate('modify');
		if(val_check){
			var tmp_email = email.value;
			email = email.value.split('@');
			var email1 = email[0];
			var email2 = email[1];
			emailYN = (emailYN) ? "Y" : "N";
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
					email1      : email1,
					email2      : email2,
					emailYN     : emailYN,
//					tel1        : tel1.value,
//					tel2        : tel2.value,
//					tel3        : tel3.value,
					phone1      : phone1.value,
					phone2      : phone2.value,
					phone3      : phone3.value,
//					smsYN       : $(':radio[name="smsYN"]:checked').val(),
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
</script>
</body>
</html>