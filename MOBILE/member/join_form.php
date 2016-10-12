<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_MOBILE_url."index.php';</script>";
	}
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
            <h2>회원가입</h2>
            <p class="line"></p>
          </div>
          <div class="divideZone">
            <div class="inputBox">
              <div class="guideText">
                <p>아이디<span>*</span></p>
              </div>
              <div class="typingBox">
                <input type="text" id="user_id" name="user_id" onblur="dupli_chk(this.value);return false;">
                <p>(영문소문자/숫자, 4~16자)</p>
                <span id="check_alert1" style="color:#b88b5b;letter-spacing:-1px;"></span>
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
                <p>비밀번호<span>*</span></p>
              </div>
              <div class="typingBox">
                <input type="password" id="password" name="password">
                <p>(영문소문자/숫자, 4~16자)</p>
              </div>
            </div>
            <div class="inputBox pb10">
              <div class="guideText">
                <p>비밀번호확인<span>*</span></p>
              </div>
              <div class="typingBox">
                <input type="password" id="passchk" onblur="pass_chk(this.value);return false;">
                <p>(영문소문자/숫자, 4~16자)</p>
                <span id="check_alert2" style="color:#b88b5b;letter-spacing:-1px;"></span>
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
                <p>이름<span>*</span></p>
              </div>
              <div class="typingBox">
                <input type="text" id="username" name="username">
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
                <p>휴대전화<span>*</span></p>
              </div>
              <div class="typingBox n3">
                <input type="tel" id="phone1" name="phone1">
                <input type="tel" id="phone2" name="phone2">
                <input type="tel" id="phone3" name="phone3">
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
                <p>이메일<span>*</span></p>
              </div>
              <div class="typingBox">
                <input type="text" id="email" name="email">
                <div class="checks">
                  <input type="checkbox" id="ex_chk" name="emailYN" value="Y">
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
                <input type="text" id="zipcode" name="zipcode" disabled>
                <input type="button" value="우편번호" id="find_addr" class="zipcodeBtn">
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
              </div>
              <div class="typingBox">
                <input type="text" placeholder="기본주소" name="addr1" id="addr1">
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
              </div>
              <div class="typingBox">
                <input type="text" placeholder="상세주소" name="addr2" id="addr2">
                <p>미리 입력해두면 주문/배송시 더 간편해집니다.</p>
              </div>
            </div>
            <div class="inputBox">
              <div class="guideText">
                <p>생년월일</p>
              </div>
              <div class="typingBox n3">
                <input type="text" name="birthY" id="birthY" placeholder="년">
                <input type="text" name="birthM" id="birthM" placeholder="월">
                <input type="text" name="birthD" id="birthD" placeholder="일">
                <p>생일에 특별한 쿠폰을 드립니다</p>
              </div>
            </div>
          </div>
          <div class="termsZone">
            <div class="agreeChk">
              <p>이용약관 동의</p>
              <div class="checks">
                <input type="checkbox" id="notice1">
                <label for="notice1">약관동의</label>
              </div>
            </div>
            <div class="termsCnt">
              <div class="inner">
                <p style="color:#767676;">이용약관내용</p>
              </div>
            </div>
          </div>
          <div class="termsZone">
            <div class="agreeChk">
              <p>개인정보 수집 및 이용 동의</p>
              <div class="checks">
                <input type="checkbox" id="notice2">
                <label for="notice2">약관동의</label>
              </div>
            </div>
            <div class="termsCnt">
              <div class="inner">
                <p style="color:#767676;">이용약관내용</p>
              </div>
            </div>
          </div>
          <div class="block_input">
            <input type="button" value="가입하기" id="submit">
          </div>
        </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
      </div>
    </div>
    <script type="text/javascript">
		var val_check;
		var id_check;
		var user_id;
		var password;
		var passchk;
		var username;
		var zipcode;
		var addr1;
		var addr2;
		var email;

		var tel1;
		var tel2;
		var tel3;
		var phone1;
		var phone2;
		var phone3;
		var notice1;
		var notice2;

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
			var emailYN = ($(':checkbox[name="emailYN"]:checked')) ? "Y" : "N";
			alert(emailYN);
			if(id_check == 'Y'){
				val_check = validate('join');
			}else{
				alert("아이디를 다시 입력해주세요.");
				$('#user_id').val('').focus;
				return;
			}

			if(val_check){
				var tmp_email = email.value;
				email = email.value.split('@');
				var email1 = email[0];
				var email2 = email[1];
//				var emailYN = ($(':checkbox[name="emailYN"]:checked')) ? "Y" : "N";
				$.ajax({
					method: 'POST',
					url: '../../main_exec.php',
					data: {
						exec		: "member_join",
						user_id		: user_id.value,
						password	: password.value,
						username	: username.value,
						zipcode		: zipcode.value,
						addr1		: addr1.value,
						addr2		: addr2.value,
						email1		: email1,
						email2		: email2,
						emailYN		: $(':checkbox[name="emailYN"]:checked').val(),
//						tel1		: tel1.value,
//						tel2		: tel2.value,
//						tel3		: tel3.value,
						phone1		: phone1.value,
						phone2		: phone2.value,
						phone3		: phone3.value,
//						smsYN		: $(':radio[name="smsYN"]:checked').val(),
						birthY		: $('#birthY').val(),
						birthM		: $('#birthM').val(),
						birthD		: $('#birthD').val()
					},
					success: function(res){
						if(res=='Y'){
							alert("환영합니다! 회원 가입되셨습니다.");
							location.href='./join_complete.php?uid='+user_id.value+'&uname='+username.value+'&uemail='+tmp_email;
						}else{
							alert("접속자가 많아 지연되고 있습니다. 다시 시도해 주세요.");
							location.reload();
						}
					}
				});
			}
		});

		function dupli_chk(input) {
			if(input == ""){
				$('#check_alert1').text("아이디를 입력해주세요.");
				return;
			}

			$.ajax({
				method: 'POST',
				url: '../../main_exec.php',
				data: {
					exec   : "duplicate_check",
					input  : input
				},
				success: function(res){
					var regExp1 = /^[a-z]{1}[a-z0-9]{5,11}$/;
					if(res == 'Y' && regExp1.test(input) == true){
						id_check = 'Y';
						$('#check_alert1').text("사용가능한 아이디입니다.");
					}else if(res == 'Y' && regExp1.test(input) == false){
						id_check = 'N';
						$('#check_alert1').text("사용불가능한 아이디입니다.");
					}else{
						id_check = 'D';
						$('#check_alert1').text("중복된 아이디입니다.");
					}
				}
			});
		}

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