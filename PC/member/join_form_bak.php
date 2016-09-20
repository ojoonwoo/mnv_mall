<?
include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
include_once $_mnv_PC_dir."header.php";
?>
<body>
  <form id="join_form">
    <h3>기본 정보 입력</h3>
    <strong>아이디 * :</strong> <input type="text" id="user_id" name="user_id" onblur="dupli_chk(this.value);return false;"> 첫글자 영문 소문자, 나머지 영문소문자/숫자 가능 6 - 12자, (ajax로 실시간 체크)
    <br>
    <em id="check_alert" style="color:#999"></em>
    <br>
    <strong>비밀번호 * :</strong> <input type="password" id="password" name="password"> 영문 첫글자 대소문자 나머지 영문대소문자/숫자/특수문자 가능 6 - 12자
    <br>
    <strong>비밀번호 확인 * :</strong> <input type="password" id="passchk">
    <br>
    <strong>이름 * :</strong> <input type="text" id="username" name="username" style="ime-mode:active">
    <br>
    <strong>주소 * :</strong> <input type="text" name="zipcode" id="zipcode" placeholder="우편번호" readonly="true"> <input type="button" id="find_addr" value="주소검색">
    <br>
    <input type="text" name="addr1" id="addr1" placeholder="기본주소" size="30" readonly="true"> 기본주소
    <br>
    <input type="text" name="addr2" id="addr2" placeholder="나머지주소"> 나머지주소
    <br>
    <strong>휴대전화 * :</strong>
    <select id="phone1" name="phone1">
      <option value="010">010</option>
      <option value="011">011</option>
      <option value="016">016</option>
      <option value="017">017</option>
      <option value="018">018</option>
      <option value="019">019</option>
    </select>
    - <input type="text" id="phone2" name="phone2"> - <input type="text" id="phone3" name="phone3">
    <br>
    <strong>SMS 수신여부 * :</strong>
    <input type="radio" name="smsYN" value="Y" checked>수신함
    <input type="radio" name="smsYN" value="N">수신안함
    <br>
    <strong>이메일 * :</strong>
    <input type="text" id="email1" name="email1"> @ <input type="text" id="email2" name="email2"> 
    <select id="email3">
      <option value="direct">직접입력</option>
      <option value="gmail.com">gmail.com</option>
      <option value="naver.com">naver.com</option>
      <option value="hanmail.net">hanmail.net</option>
    </select>
    <br>
    <strong>이메일 수신여부 * :</strong>
    <input type="radio" name="emailYN" value="Y" checked>수신함
    <input type="radio" name="emailYN" value="N">수신안함
    <br><br>
    <h3>추가 정보 입력</h3><br>
    <strong>생년월일 :</strong> 
    <input type="text" name="birthY" id="birthY">년<input type="text" name="birthM" id="birthM">월<input type="text" name="birthD" id="birthD">일
    <br><br>
    <strong>일반전화 :</strong>
    <select id="tel1" name="tel1">
      <option value="02" selected>02</option>
      <option value="031">031</option>
      <option value="032">032</option>
    </select>
    - <input type="text" id="tel2" name="tel2"> - <input type="text" id="tel3" name="tel3">
    <br><br>
    <strong>이용약관</strong><br><br>
    <input type="checkbox" id="notice1"> 동의함
    <input type="checkbox" id="notice2"> 동의함
    <br><br>
    <input type="button" id="submit" value="회원가입">&nbsp;&nbsp;&nbsp;
    <input type="reset" value="회원가입 취소">
  </form>
  <script type="text/javascript">
    var val_check;
    var id_check;
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
      if(id_check == 'Y'){
        val_check = validate('join');
      }else{
        alert("아이디를 다시 입력해주세요.");
        $('#user_id').val('').focus;
        return;
      }

      if(val_check){
        $.ajax({
          method: 'POST',
          url: '../../main_exec.php',
          data: {
            exec			: "member_join",
            user_id		: user_id.value,
            password	: password.value,
            username	: username.value,
            zipcode		: zipcode.value,
            addr1			: addr1.value,
            addr2			: addr2.value,
            email1		: email1.value,
            email2		: email2.value,
            emailYN		: $(':radio[name="emailYN"]:checked').val(),
            tel1			: tel1.value,
            tel2			: tel2.value,
            tel3			: tel3.value,
            phone1		: phone1.value,
            phone2		: phone2.value,
            phone3		: phone3.value,
            smsYN		: $(':radio[name="smsYN"]:checked').val(),
            phone2		: phone2.value,
            birthY		: $('#birthY').val(),
            birthM		: $('#birthM').val(),
            birthD		: $('#birthD').val()
          },
          success: function(res){
            if(res=='Y'){
              alert("가입 성공");
              location.href='./member_index.php';;
            }else{
              alert("가입 실패");
            }
          }
        });
      }
    });

    function dupli_chk(input) {
      if(input == ""){
        $('#check_alert').text("아이디를 입력해주세요.");
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
            $('#check_alert').text("사용가능한 아이디입니다.");
          }else if(res == 'Y' && regExp1.test(input) == false){
            id_check = 'N';
            $('#check_alert').text("사용불가능한 아이디입니다.");
          }else{
            id_check = 'D';
            $('#check_alert').text("중복된 아이디입니다.");
          }
        }
      });
    }
  </script>
</body>
</html>

