<?
include_once "../header.php";
?>
<body>
  <form action="./member_info_user.php" method="post" onsubmit="return validate();">
    <h3>기본 정보 입력</h3>
    <strong>아이디 * :</strong> <input type="text" id="userid" name="userid" onblur="dupli_chk('id',this.value);return false;"> 영문 소문자+숫자, 4 - 16자, 숫자 처음X, 숫자로만 X (ajax로 실시간 체크)
    <br>
    <em id="check_alert" style="color:#999"></em>
    <br>
    <strong>비밀번호 * :</strong> <input type="password" id="password" name="password"> 영문 대소문자, 최소 1개의 숫자/ 특수 문자 포함
    <br>
    <strong>비밀번호 확인 * :</strong> <input type="password" id="passchk">
    <br>
    <strong>비밀번호 확인 질문 * :</strong>
    <select id="password_Q" name="password_Q">
      <option value="1">기억에 남는 추억의 장소는?</option>
      <option value="2">자신의 인생 좌우명은?</option>
      <option value="3">자신의 보물 제1호는?</option>
    </select>
    <br>
    <strong>비밀번호 확인 답변 * :</strong> <input type="text" id="password_A" name="password_A">
    <br>
    <strong>이름 * :</strong> <input type="text" id="username" name="username" style="ime-mode:active">
    <br>
    <strong>주소 * :</strong> <input type="text" name="zipcode" id="zipcode" placeholder="우편번호"> <button onclick="daum_postcode();return false;">주소검색</button>
    <br>
    <input type="text" name="addr1" id="addr1" placeholder="기본주소"> 기본주소
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
    <input type="text" id="email1" name="email1"> @ <input type="text" id="email2" name="email2" readonly="true"> 
    <select id="email3" onchange="auto_insert();return false;">
      <option>이메일 선택</option>
      <option value="gmail.com">gmail.com</option>
      <option value="naver.com">naver.com</option>
      <option value="hanmail.net">hanmail.net</option>
      <option>직접입력</option>
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
    <strong>성별</strong>
    <input type="radio" name="gender" value="M" checked>남
    <input type="radio" name="gender" value="F">여
    <br><br>
    <strong>이용약관</strong><br><br>
    <input type="checkbox" name="notice1" checked> 동의함
    <input type="checkbox" name="notice2" checked> 동의함
    <br><br>
    <input type="hidden" name="type" value="register">
    <button type="submit">회원가입</button>&nbsp;&nbsp;&nbsp;
    <button type="reset">회원가입 취소</button>
  </form>
<script type="text/javascript">

  function dupli_chk(type, input) {
    if(input == ""){
      $('#check_alert').text("아이디를 입력해주세요.");
      return;
    }

    $.ajax({
      method: 'POST',
      url: '../main_exec.php',
      data: {
        exec            : "duplicate_check",
        type : type,
        input  : input
      },
      success: function(res){
        var regExp1 = /^[a-z][a-z\d]{3,11}$/;
        var regExp2 = /[0-9]/;
        if(res == 'Y' && regExp1.test(input) == true && regExp2.test(input) == true){
          $('#check_alert').text("사용가능한 아이디입니다.");
        }else{
          $('#check_alert').text("사용불가능한 아이디입니다.")
        }
      }
    });
  }

  function daum_postcode() {
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
  }

  function validate() {
      var userid = document.getElementById('userid');
      var password = document.getElementById('password');
      var passchk = document.getElementById('passchk');
      var username = document.getElementById('username');
      var zipcode = document.getElementById('zipcode');
      var addr1 = document.getElementById('addr1');
      var addr2 = document.getElementById('addr2');
      var password_Q = document.getElementById('password_Q');
      var password_A = document.getElementById('password_A');
      var email1 = document.getElementById('email1');
      var email2 = document.getElementById('email2');
      var tel1 = document.getElementById('tel1');
      var tel2 = document.getElementById('tel2');
      var tel3 = document.getElementById('tel3');
      var phone1 = document.getElementById('phone1');
      var phone2 = document.getElementById('phone2');
      var phone3 = document.getElementById('phone3');

      // 아이디 검사
      // 첫 글자는 반드시 영문 소문자, 4~12자로 이루어지고, 숫자가
      // 하나 이상 포함되어야 한다. 영문소문자와 숫자로만 이루어져야한다.
      // \d : [0-9]와 같다.       {n,m} : n에서 m까지 글자수
      if(!chk(/^[a-z][a-z\d]{3,11}$/, userid, "아이디의 첫글자는 영문 소문자, 4~12자 입력할것!"))
             return false;
      if(!chk(/[0-9]/, userid, "아이디에 숫자 하나이상포함!"))
             return false;

      // 비밀번호 검사
      // 영문 대소문자
      // 최소 1개의 숫자 혹은 특수 문자를 포함해야 함
      // if(!chk(/^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{4,12}$/, password, "비밀번호에 대소문자, 최소 1개의 숫자/ 특수 문자 포함"))
      //        return false;

      if(!chk(/^[a-zA-Z0-9]{4,12}$/, password, "비밀번호는 숫자, 영문자 혼합으로 4~12자 입력할것"))
             return false;

      // 비밀번호 확인 검사
      if(password.value!=passchk.value) {
             alert("비밀번호가 틀립니다");
             return false;
      }
     
      // 이름 검사
      // 2글자 이상, 한글만
      // 통과하지 못하면 한글로 2글자 이상을 넣으세요~ alert 출력!
      if(!chk(/^[가-힝]{2,}$/, username, "이름은 한글로 2글자 이상을 넣으세요."))
             return false;


      // 우편번호, 주소 검사
      if(zipcode.value == '' || addr1.value == '') {
        alert("주소를 입력해주세요.");
        return false;
      }
     
      // 전화번호 검사

      // 전화번호 앞자리는 2~3자리 숫자, 두번째 자리는 3~4자리 숫자
      // 세번째 자리는 4자리 숫자

      // if (tel1.value != '') {
      //        if (!chk(/^[0-9]{3,}$/, tel2, "번호 3자리 이상 입력"))
      //                return false;
      //        if (!chk(/^[0-9]{4}$/, tel3, "4자리 번호 입력"))
      //                return false;
      //        }

      if (phone1.value != '') {
             if (!chk(/^[0-9]{3,}$/, phone2, "번호 3자리 이상 입력"))
                     return false;
             if (!chk(/^[0-9]{4}$/, phone3, "4자리 번호 입력"))
                     return false;
             }

      if (email1.value != '') {
            email1.value = email1.value+'@'+email2.value;
            if(!chk(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/, email1, "이메일 주소가 올바르지 않습니다."))
               return false;
             }
    }


      // 전체 공백 체크



  function chk(re, e, msg) {
         if (re.test(e.value)) {
             return true;
         }

         alert(msg);
         e.value = "";
         e.focus();
         return false;
  }

  function auto_insert() {
    $('#email2').attr('readonly', false);
    var mail = $('#email3').val();
    if(mail=="직접입력") {
      $('#email2').val('').focus();
    }else{
      $('#email2').empty().val(mail);
      $('#email2').attr('readonly', true);
    }
  }

</script>
</body>
</html>

