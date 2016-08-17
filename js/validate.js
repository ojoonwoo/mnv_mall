<script type="text/javascript">

function validate()
{
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
}

  </script>