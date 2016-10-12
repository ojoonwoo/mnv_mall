/*
*
*	MOBILE전용 JS 파일
*
*/

// 입력값 검사
function validate(ref)
{

	user_id = document.getElementById('user_id');
	password = document.getElementById('password');
	passchk = document.getElementById('passchk');
	username = document.getElementById('username');
	zipcode = document.getElementById('zipcode');
	addr1 = document.getElementById('addr1');
	addr2 = document.getElementById('addr2');
	email = document.getElementById('email');
	tel1 = document.getElementById('tel1');
	tel2 = document.getElementById('tel2');
	tel3 = document.getElementById('tel3');
	phone1 = document.getElementById('phone1');
	phone2 = document.getElementById('phone2');
	phone3 = document.getElementById('phone3');
	notice1 = document.getElementById('notice1');
	notice2 = document.getElementById('notice2');


	// 아이디 검사
	// 첫 글자는 반드시 영문 소문자, 4~12자로 이루어지고, 숫자가
	// 하나 이상 포함되어야 한다. 영문소문자와 숫자로만 이루어져야한다.
	// \d : [0-9]와 같다.       {n,m} : n에서 m까지 글자수
	if(ref == 'join'){
		if(!chk(/^[a-z]{1}[a-z0-9]{5,11}$/, user_id, "아이디가 형식에 맞지 않습니다."))
			return false;
		// if(!chk(/^[a-z][a-z\d]{3,11}$/, user_id, "아이디의 첫글자는 영문 소문자, 4~12자 입력할것!"))
		// 	return false;
		// if(!chk(/[0-9]/, user_id, "아이디에 숫자 하나이상포함!"))
		// 	return false;

		if(!notice1.checked){
			alert("이용약관 동의를 하지 않으셨습니다.");
			return false;
		}

		if(!notice2.checked){
			alert("개인정보 수집 및 이용 동의를 하지 않으셨습니다.");
			return false;
		}
	}

	// 비밀번호 검사
	// 영문 대소문자
	// 최소 1개의 숫자 혹은 특수 문자를 포함해야 함
	// if(!chk(/^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{4,12}$/, password, "비밀번호에 대소문자, 최소 1개의 숫자/ 특수 문자 포함"))
	//return false;

	if(!chk(/^[a-zA-Z]{1}[a-zA-Z0-9\!\@\#\$\%\^\*\+\=\-\_]{5,11}$/, password, "비밀번호가 형식에 맞지 않습니다."))
		return false;
	// if(!chk(/^[a-zA-Z0-9]{4,12}$/, password, "비밀번호는 숫자, 영문자 혼합으로 4~12자 입력할것"))
	// 	return false;

	// 비밀번호 확인 검사
	if(password.value!=passchk.value) {
		alert("비밀번호가 틀립니다");
		passchk.focus();
		return false;
	}

	// 이름 검사
	// 2글자 이상, 한글만
	// 통과하지 못하면 한글로 2글자 이상을 넣으세요~ alert 출력!
	if(!chk(/^[가-힝]{2,}$/, username, "이름은 한글로 2글자 이상을 넣으세요."))
		return false;


	// 우편번호, 주소 검사
	//	if(zipcode.value == '' || addr1.value == '') {
	//		alert("주소를 입력해주세요.");
	//		return false;
	//	}


	// 전화번호 검사

	// 전화번호 앞자리는 2~3자리 숫자, 두번째 자리는 3~4자리 숫자
	// 세번째 자리는 4자리 숫자

	// if (tel1.value != '') {
	//        if (!chk(/^[0-9]{3,}$/, tel2, "번호 3자리 이상 입력"))
	//                return false;
	//        if (!chk(/^[0-9]{4}$/, tel3, "4자리 번호 입력"))
	//                return false;
	//        }

	if (phone1.value == '') {
		alert("휴대폰번호를 입력해주세요.");
		phone1.focus();
		return false;
	}

	if (phone1.value != '') {
		if (!chk(/^[0-9]{3,}$/, phone2, "휴대폰번호를 3자리 이상 입력해주세요."))
			return false;
		if (!chk(/^[0-9]{4}$/, phone3, "휴대폰번호를 4자리 입력해주세요."))
			return false;
	}

	if (email.value == '') {
		alert("이메일을 입력해주세요.");
		email.focus();
		return false;
	}

	if (email.value != '') {
	
		if(!chk(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, email, "이메일 주소가 올바르지 않습니다."))
			return false;
		// if(!chk(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/, email1, "이메일 주소가 올바르지 않습니다."))
		// 	return false;
	}


	return true;
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


// 회원 로그인
$(document).on("click", "#mb_login", function(){
	var mb_id					= $("#mb_id").val();
	var mb_password			= $("#mb_password").val();
	var pg_referer				= $("#pg_referer").val();

	if (mb_id == "")
	{
		alert("아이디를 입력해주세요.");
		$("#mb_id").focus();
		return false;
	}

	if (mb_password == "")
	{
		alert("비밀번호를 입력해주세요.");
		$("#mb_password").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "member_login",
			"mb_id"				: mb_id,
			"mb_password"		: mb_password
		},
		success: function(response){
			if (response == "Y")
			{
				if (pg_referer == "")
					location.href = "../index.php";
				else
					location.href = pg_referer;
			}else{
				alert("아이디와 비밀번호를 다시 확인하시고, 로그인해주세요..");
				location.reload();
			}
		}
	});
});