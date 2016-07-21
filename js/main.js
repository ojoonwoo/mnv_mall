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
	alert('1111');
});

