/*
*
*	PC전용 JS 파일
*
*/



$(document).on("click", "#cate1_btn_td a", function(){
	$("#cate1_btn_td").hide();
	$("#cate1_sel_td").show();
});

$(document).on("click", "#cate2_btn_td a", function(){
	if ($("#cate1_sel_td").css("display") == "none")
	{
		alert("1차 카테고리를 먼저 선택해 주셔야 합니다.");
		return false;
	}
	$("#cate2_btn_td").hide();
	$("#cate2_sel_td").show();
});

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

$(document).on("click", "#submit_btn a", function(){
	var cate_name				= $("#cate_name").val();
	var cate_1					= $("#cate_1").val();
	var cate_2					= $("#cate_2").val();
	var cate_3					= $("#cate_3").val();
	var cate_pcYN				= $(':radio[name="cate_pcYN"]:checked').val();
	var cate_mobileYN		= $(':radio[name="cate_mobileYN"]:checked').val();
	var cate_accessYN		= $(':radio[name="cate_accessYN"]:checked').val();

	if (cate_name == "")
	{
		alert("카테고리 이름을 입력해주세요.");
		$("#cate_name").focus();
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
			"cate_accessYN"		: cate_accessYN
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

function show_select_cate2(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../main_exec.php",
		data:{
			"exec"	: "show_select_cate2"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

