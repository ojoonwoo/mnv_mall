<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$user_data		= select_member_info();

	$split_email	= explode('@', $user_data['mb_email']);
	$split_birth		= explode('/', $user_data['mb_birth']);
	$split_phone	= explode('-', $user_data['mb_handphone']);
	$split_tel		= explode('-', $user_data['mb_telphone']);
?>
<body>
  <form method="post" id="modify_form">
    <h3>기본 정보 입력</h3>
    <strong>아이디 * :</strong> <input type="text" id="user_id" name="user_id" value="<?=$user_data['mb_id']?>" readonly="true"> 
    <br>
    <strong>비밀번호 * :</strong> <input type="password" id="password" name="password"> 영문 첫글자 대소문자 나머지 영문대소문자/숫자/특수문자 가능 6 - 12자
    <br>
    <strong>비밀번호 확인 * :</strong> <input type="password" id="passchk">
    <br>
    <strong>이름 * :</strong> <input type="text" id="username" name="username" value="<?=$user_data['mb_name']?>" style="ime-mode:active">
    <br>
    <strong>주소 * :</strong> <input type="text" name="zipcode" id="zipcode" value="<?=$user_data['mb_zipcode']?>" readonly="true"> <input type="button" id="find_addr" value="주소검색">
    <br>
    <input type="text" name="addr1" id="addr1" value="<?=$user_data['mb_address1']?>" size="30" readonly="true"> 기본주소
    <br>
    <input type="text" name="addr2" id="addr2" value="<?=$user_data['mb_address2']?>"> 나머지주소
    <br>
    <strong>휴대전화 * :</strong>
    <select id="phone1" name="phone1">
      <option <? if($split_phone[0] == '010') echo 'selected'; ?> value="010">010</option>
      <option <? if($split_phone[0] == '011') echo 'selected'; ?> value="011">011</option>
      <option <? if($split_phone[0] == '016') echo 'selected'; ?> value="016">016</option>
      <option <? if($split_phone[0] == '017') echo 'selected'; ?> value="017">017</option>
      <option <? if($split_phone[0] == '018') echo 'selected'; ?> value="018">018</option>
      <option <? if($split_phone[0] == '019') echo 'selected'; ?> value="019">019</option>
    </select>
    - <input type="text" id="phone2" name="phone2" value="<?=$split_phone[1]?>"> - <input type="text" id="phone3" name="phone3" value="<?=$split_phone[2]?>">
    <br>
    <strong>SMS 수신여부 * :</strong>
    <input type="radio" name="smsYN" <? if($user_data['mb_smsYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
    <input type="radio" name="smsYN" <? if($user_data['mb_smsYN'] == 'N') echo 'checked'; ?> value="N">수신안함
    <br>
    <strong>이메일 * :</strong>
    <input type="text" id="email1" name="email1" value="<?=$split_email[0]?>"> @ <input type="text" id="email2" name="email2" value="<?=$split_email[1]?>" readonly="true"> 
    <select id="email3">
      <option value="direct">직접입력</option>
      <option value="gmail.com">gmail.com</option>
      <option value="naver.com">naver.com</option>
      <option value="hanmail.net">hanmail.net</option>
    </select>
    <br>
    <strong>이메일 수신여부 * :</strong>
    <input type="radio" name="emailYN" <? if($user_data['mb_emailYN'] == 'Y') echo 'checked'; ?> value="Y">수신함
    <input type="radio" name="emailYN" <? if($user_data['mb_emailYN'] == 'N') echo 'checked'; ?> value="N">수신안함
    <br><br>
    <h3>추가 정보 입력</h3><br>
    <strong>생년월일 :</strong> 
    <input type="text" name="birthY" id="birthY" value="<?=$split_birth[0]?>">년<input type="text" name="birthM" id="birthM" value="<?=$split_birth[1]?>">월<input type="text" name="birthD" id="birthD" value="<?=$split_birth[2]?>">일
    <br><br>
    <strong>일반전화 :</strong>
    <select id="tel1" name="tel1">
      <option <? if($split_tel[0] == '02') echo 'selected'; ?> value="02">02</option>
      <option <? if($split_tel[0] == '031') echo 'selected'; ?> value="031">031</option>
      <option <? if($split_tel[0] == '032') echo 'selected'; ?> value="032">032</option>
    </select>
    - <input type="text" id="tel2" name="tel2" value="<?=$split_tel[1]?>"> - <input type="text" id="tel3" name="tel3" value="<?=$split_tel[2]?>">
    <br><br>
    <input type="button" id="submit" value="수정">&nbsp;&nbsp;&nbsp;
    <input type="button" id="cancel_modify_member"  value="취소">
  </form>
<script type="text/javascript">
	$(window).load(function() {
		if($('#birthY').val() !== ''){
			$('#birthY').attr('readonly', 'true');
			$('#birthM').attr('readonly', 'true');
			$('#birthD').attr('readonly', 'true');
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

	$('#email3').on('change', function(){
		$('#email2').attr('disabled', false);
		var mail = $('#email3').val();
		if(mail=="direct") {
			$('#email2').val('').focus();
		}else{
			$('#email2').val('').val(mail);
			$('#email2').attr('disabled', true);
		}
	});

	$('#submit').on('click', function(){
		var val_check = validate('modify');
		if(val_check){
			$.ajax({
				method: 'POST',
				url: '../main_exec.php',
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
						alert("수정 성공");
						location.href='./member_index.php';
					}else{
						alert("수정 실패");
					}
				}
			});
		}
	});

	$(document).on("click", "#cancel_modify_member", function(){
		history.back();
	});
</script>
</body>
</html>