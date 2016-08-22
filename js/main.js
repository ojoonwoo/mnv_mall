/*
*
*	PC전용 JS 파일
*
*/

// 1차 카테고리 선택 메뉴 show
$(document).on("click", "#cate1_btn_td a", function(){
	$("#cate1_btn_td").hide();
	$("#cate1_sel_td").show();
});

// 2차 카테고리 선택 메뉴 show
$(document).on("click", "#cate2_btn_td a", function(){
	if ($("#cate1_sel_td").css("display") == "none")
	{
		alert("1차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	$("#cate2_btn_td").hide();
	$("#cate2_sel_td").show();
});

// 3차 카테고리 선택 메뉴 show
$(document).on("click", "#cate3_btn_td a", function(){
	if ($("#cate1_sel_td").css("display") == "none")
	{
		alert("1차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	if ($("#cate2_sel_td").css("display") == "none")
	{
		alert("2차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	$("#cate3_btn_td").hide();
	$("#cate3_sel_td").show();
});

// 1차 카테고리 선택시 2차 카테고리 내용 변경
$(document).on("change", "#cate_1", function(){
	show_select_cate2("cate_2");
});

// 배너 구분 선택시 상세내용 설정
$(document).on("change", "#banner_type", function(){
	show_banner_config();
});



// 카테고리 정보 insert
$(document).on("click", "#submit_btn a", function(){
	var cate_name				= $("#cate_name").val();
	var cate_1					= $("#cate_1").val();
	var cate_2					= $("#cate_2").val();
	var cate_3					= $("#cate_3").val();
	var cate_pcYN				= $(':radio[name="cate_pcYN"]:checked').val();
	var cate_mobileYN		= $(':radio[name="cate_mobileYN"]:checked').val();
	var cate_accessYN		= $(':radio[name="cate_accessYN"]:checked').val();
	var access_specific		= $("#access_specific").val();
	if (cate_name == "")
	{
		alert("카테고리 이름을 입력해주세요.");
		$("#cate_name").focus();
		return false;
	}

	if (cate_accessYN == "SPECIFIC")
	{
		if (access_specific == "")
		{
			alert("카테고리가 보여질 회원등급을 선택해 주세요.");
			return false;
		}
	}
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"			: "insert_cate_info",
			"cate_name"			: cate_name,
			"cate_1"					: cate_1,
			"cate_2"					: cate_2,
			"cate_3"					: cate_3,
			"cate_pcYN"			: cate_pcYN,
			"cate_mobileYN"		: cate_mobileYN,
			"cate_accessYN"		: cate_accessYN,
			"access_specific"		: access_specific
		},
		success: function(response){
			if (response == "Y")
			{
				alert("카테고리가 추가 되었습니다.");
				location.reload();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});

});

$(document).on("click", "#banner_submit", function(){
	var device_distinct = $('#device_distinct').val();
	var banner_title = $('#banner_title').val();
});

// 회원 등급 select 새로 생성
function show_select_grade(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_select_grade"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리1 select 새로 생성
function show_select_cate1(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_select_cate1"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리2 select 새로 생성
function show_select_cate2(id)
{
	var cate_1	= $("#cate_1").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_select_cate2",
			"cate_1"	: cate_1
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 전체 카테고리 리스트 생성
function show_category_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_category_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 배너 설정에서 배너 타입 불러오기
function show_select_banner_type(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_select_banner_type"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 배너 설정에서 선택한 배너 상세 정보 불러오기
function show_banner_config()
{
	var banner_type	= $("#banner_type").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"				: "show_banner_detail",
			"banner_type"		: banner_type

		},
		error: function(response){
			console.log(response);
		},
		success: function(response){
			// 배너 설정 DB에서 불러와 세팅
			var banner_config_arr	= response.split("||");
			$("#slide_speed").val(banner_config_arr[0]);
			$("#slide_interval").val(banner_config_arr[1]);
			$('input:radio[name=slide_effect]:input[value='+banner_config_arr[2]+']').attr("checked", true);
			$("#bn_slide_speed").show();
			$("#bn_slide_interval").show();
			$("#bn_slide_effect").show();
		}
	});

}

// 입력값 검사
function validate(ref)
{
	var user_id = document.getElementById('user_id');
	var password = document.getElementById('password');
	var passchk = document.getElementById('passchk');
	var username = document.getElementById('username');
	var zipcode = document.getElementById('zipcode');
	var addr1 = document.getElementById('addr1');
	var addr2 = document.getElementById('addr2');
	var email1 = document.getElementById('email1');
	var email2 = document.getElementById('email2');
	var tel1 = document.getElementById('tel1');
	var tel2 = document.getElementById('tel2');
	var tel3 = document.getElementById('tel3');
	var phone1 = document.getElementById('phone1');
	var phone2 = document.getElementById('phone2');
	var phone3 = document.getElementById('phone3');
	var notice1 = document.getElementById('notice1');
	var notice2 = document.getElementById('notice2');


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
			alert("1번에 동의하지 않으셨습니다.");
			return false;
		}
		if(!notice2.checked){
			alert("2번에 동의하지 않으셨습니다.");
			return false;
		}
	}

	// 비밀번호 검사
	// 영문 대소문자
	// 최소 1개의 숫자 혹은 특수 문자를 포함해야 함
	// if(!chk(/^(?=.*[a-zA-Z])((?=.*\d)|(?=.*\W)).{4,12}$/, password, "비밀번호에 대소문자, 최소 1개의 숫자/ 특수 문자 포함"))
	//return false;

	if(!chk(/^[a-zA-Z]{1}[a-zA-Z0-9\!\@\#\$\%\^\*\+\=\-]{5,11}$/, password, "비밀번호가 형식에 맞지 않습니다."))
		return false;
	// if(!chk(/^[a-zA-Z0-9]{4,12}$/, password, "비밀번호는 숫자, 영문자 혼합으로 4~12자 입력할것"))
	// 	return false;

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
		var tmp_email = email1.value;
		email1.value = email1.value+'@'+email2.value;
		
		if(!chk(/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/, email1, "이메일 주소가 올바르지 않습니다."))
			return false;
		// if(!chk(/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/, email1, "이메일 주소가 올바르지 않습니다."))
		// 	return false;
	}
	email1.value = tmp_email;
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