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