/*
*
*	관리자 JS 파일
*
*/

// *********************** 카테고리 *********************** //

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

// 관리자 카테고리 관리 > 카테고리 추가 버튼 클릭
$(document).on("click", "#add_category_btn", function(){
	$("#list_category").hide();
	$("#add_category").show();
});

// 관리자 카테고리 관리 > 카테고리 목록 버튼 클릭
$(document).on("click", "#list_category_btn", function(){
	$("#add_category").hide();
	$("#list_category").show();
});

// 1차 카테고리 선택시 2차 카테고리 내용 변경
$(document).on("change", "#cate_1", function(){
	show_select_cate2("cate_2");
});

// 2차 카테고리 선택시 3차 카테고리 내용 변경
$(document).on("change", "#cate_2", function(){
	show_select_cate3("cate_3");
});

// 회원 등급 select 새로 생성
function show_select_grade(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
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
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_select_cate1"
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리1 선택된값 세팅
function selected_category(id,cate1_val,cate2_val,cate3_val)
{
	$("#"+id).val(cate1_val);
	show_select_cate2("cate_2");
	$("#cate_2").val(cate2_val);
	show_select_cate3("cate_3");
	$("#cate_3").val(cate3_val);
}

// 카테고리2 select 새로 생성
function show_select_cate2(id)
{
	var cate_1	= $("#cate_1").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_select_cate2",
			"cate_1"	: cate_1
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리3 select 새로 생성
function show_select_cate3(id)
{
	var cate_1	= $("#cate_1").val();
	var cate_2	= $("#cate_2").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_select_cate3",
			"cate_1"	: cate_1,
			"cate_2"	: cate_2
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
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_category_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 카테고리 정보 insert
$(document).on("click", "#submit_btn", function(){
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
		url    : "../../main_exec.php",
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

// 카테고리 정보 update
$(document).on("click", "#submit_btn4", function(){
	var idx						= $("#idx").val();
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
		url    : "../../main_exec.php",
		data:{
			"exec"					: "update_cate_info",
			"idx"						: idx,
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
			alert(response);
			if (response == "Y")
			{
				alert("카테고리정보가 수정 되었습니다.");
				location.href='category.php';
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// *********************** 상품관리 *********************** //

// 관리자 상품 관리 > 옵션사용 클릭
var option_txt		= "";
var option_num	= "1";
$(document).on("click", "#goods_optionY", function(){
	option_txt	= "<input class='form-control' id='goods_option"+option_num+"'> <button type='button' class='btn btn-primary option_add_btn'>+ 추가</button><br />";
	$("#option_detail_div").html(option_txt);
});

// 관리자 상품 관리 > 옵션사용안함 클릭
$(document).on("click", "#goods_optionN", function(){
	$("#option_detail_div").html("");
});

// 관리자 상품 관리 > 옵션 추가 버튼 클릭
$(document).on("click", ".option_add_btn", function(){
	option_num	= option_num + 1;
	option_txt	= "<input class='form-control' id='goods_option"+option_num+"'> <button type='button' class='btn btn-primary option_add_btn'>+ 추가</button><br />";
	$("#option_detail_div").append(option_txt);
});

// 관리자 상품 관리 > 적립금 직접 등록
$(document).on("click", "#saved_priceN", function(){
	$("#save_detail_div").show();
});

// 관리자 상품 관리 > 적립금 별도 설정
$(document).on("click", "#saved_priceY", function(){
	$("#save_detail_div").hide();
});

// 관리자 상품 관리 > 모바일 상품 상세설명 입력
$(document).on("click", "#m_goods_big_descY", function(){
	$("#mobile_detail_div").show();
});

// 관리자 상품 관리 > 모바일 상품 상세설명 입력안함
$(document).on("click", "#m_goods_big_descN", function(){
	$("#mobile_detail_div").hide();
});

// 관리자 상품 관리 > 재고관리 > 재고 더블클릭
$(document).on("dblclick", ".stock_td", function(){
	var thisval	= $(this).html();
	$(this).attr('class','stock_td_fin');
	$(this).html("<input class='form-control' value='"+thisval+"'>");
	$(".stock_td_fin input").focus();
});

// 관리자 상품 관리 > 재고관리 > 재고 더블클릭 이후 블러처리
$(document).on("blur", ".stock_td_fin", function(){
	var thisval	= $(".stock_td_fin input").val();

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "update_stock_info",
			"goods_code"		: this.id,
			"goods_stock"		: thisval
		},
		success: function(response){
			if (response == "Y")
			{
				$(".stock_td_fin").html(thisval);
				$(".stock_td_fin").attr('class','stock_td');
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 전체 상품 리스트 생성
function show_goods_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_goods_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}

// 전체 재고 리스트 생성
function show_stock_list(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"	: "show_stock_list",
			"target"	: id
		},
		success: function(response){
			$("#"+id).html(response);
		}
	});
}


// 상품 정보 insert
$(document).on("click", "#submit_btn2", function(){
	var showYN						= $(':radio[name="showYN"]:checked').val();
	var salesYN							= $(':radio[name="salesYN"]:checked').val();
	var cate_1							= $("#cate_1").val();
	var cate_2							= $("#cate_2").val();
	var cate_3							= $("#cate_3").val();
	var goods_name					= $("#goods_name").val();
	var goods_eng_name			= $("#goods_eng_name").val();
	var goods_model					= $("#goods_model").val();
	var goods_brand					= $("#goods_brand").val();
	var goods_status					= $(':radio[name="goods_status"]:checked').val();
	var goods_small_desc			= $("#goods_small_desc").val();
	var goods_middle_desc			= $("#goods_middle_desc").val();
	var goods_big_desc				= oEditors.getById["goods_big_desc"].getIR();
	var m_goods_big_descYN		= $(':radio[name="m_goods_big_descYN"]:checked').val();
	var supply_price					= $("#supply_price").val();
	var sales_price						= $("#sales_price").val();
	var saved_priceYN				= $(':radio[name="saved_priceYN"]:checked').val();
	var goods_optionYN				= $(':radio[name="goods_optionYN"]:checked').val();
	var goods_option_txt			= "";
	var goods_stock					= $("#goods_stock").val();
	var m_goods_big_desc	= "";
	var saved_price	= "";

	if (cate_1 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (cate_2 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
/*
	if (cate_3 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}
*/
	if (goods_name == "")
	{
		alert("상품명을 입력해주세요.");
		$("#goods_name").focus();
		return false;
	}

	if (goods_small_desc == "")
	{
		alert("상품 요약 설명을 입력해주세요.");
		$("#goods_small_desc").focus();
		return false;
	}

	if (goods_middle_desc == "")
	{
		alert("상품 간략 설명을 입력해주세요.");
		$("#goods_middle_desc").focus();
		return false;
	}

	if (goods_big_desc == "")
	{
		alert("상품 상세 설명을 입력해주세요.");
		$("#goods_big_desc").focus();
		return false;
	}

	if (m_goods_big_descYN == "new")
	{
		m_goods_big_desc		= m_oEditors.getById["m_goods_big_desc"].getIR();
		if (m_goods_big_desc == "")
		{
			alert("모바일 상품 상세 설명을 입력해주세요.");
			$("#m_goods_big_desc").focus();
			return false;
		}
	}

	if (supply_price == "")
	{
		alert("공급가를 입력해주세요.");
		$("#supply_price").focus();
		return false;
	}

	if (sales_price == "")
	{
		alert("판매가를 입력해주세요.");
		$("#sales_price").focus();
		return false;
	}

	if (saved_priceYN == "N")
	{
		saved_price				= $("#saved_price").val();
		if (saved_price == "")
		{
			alert("적립금을 입력해주세요.");
			$("#saved_price").focus();
			return false;
		}
	}

	if (goods_optionYN == "Y")
	{
		for (var i=1; i<=option_num; i++ )
		{
			goods_option_txt			+= "||" + $("#goods_option"+i).val();
		}
		if (goods_option_txt == "")
		{
			alert("상품 옵션을 입력해 주세요.");
			return false;
		}
	}

	if (goods_stock == "")
	{
		alert("재고수량을 입력해주세요.");
		$("#goods_stock").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"						: "insert_goods_info",
			"showYN"					: showYN,
			"salesYN"					: salesYN,
			"cate_1"						: cate_1,
			"cate_2"						: cate_2,
			"cate_3"						: cate_3,
			"goods_name"				: goods_name,
			"goods_eng_name"		: goods_eng_name,
			"goods_model"			: goods_model,
			"goods_brand"			: goods_brand,
			"goods_status"			: goods_status,
			"goods_small_desc"		: goods_small_desc,
			"goods_middle_desc"	: goods_middle_desc,
			"goods_big_desc"		: goods_big_desc,
			"m_goods_big_descYN"	: m_goods_big_descYN,
			"m_goods_big_desc"		: m_goods_big_desc,
			"supply_price"				: supply_price,
			"sales_price"				: sales_price,
			"saved_priceYN"			: saved_priceYN,
			"saved_price"				: saved_price,
			"goods_optionYN"		: goods_optionYN,
			"goods_option_txt"		: goods_option_txt,
			"goods_stock"				: goods_stock,
		},
		success: function(response){
			var res_arr = response.split("||");
			goods_code	= res_arr[1];
			if (res_arr[0]== "Y")
			{
				img_submit();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 상품 정보 update
$(document).on("click", "#submit_btn3", function(){
	var showYN						= $(':radio[name="showYN"]:checked').val();
	var salesYN							= $(':radio[name="salesYN"]:checked').val();
	var cate_1							= $("#cate_1").val();
	var cate_2							= $("#cate_2").val();
	var cate_3							= $("#cate_3").val();
	var goods_name					= $("#goods_name").val();
	var goods_eng_name			= $("#goods_eng_name").val();
	var goods_model					= $("#goods_model").val();
	var goods_status					= $(':radio[name="goods_status"]:checked').val();
	var goods_small_desc			= $("#goods_small_desc").val();
	var goods_middle_desc			= $("#goods_middle_desc").val();
	var goods_big_desc				= oEditors.getById["goods_big_desc"].getIR();
	var m_goods_big_descYN		= $(':radio[name="m_goods_big_descYN"]:checked').val();
	var supply_price					= $("#supply_price").val();
	var sales_price						= $("#sales_price").val();
	var saved_priceYN				= $(':radio[name="saved_priceYN"]:checked').val();
	var goods_optionYN				= $(':radio[name="goods_optionYN"]:checked').val();
	var goods_option_txt			= "";
	var goods_stock					= $("#goods_stock").val();
	goods_code						= $("#goodscode").val();
	var m_goods_big_desc	= "";
	var saved_price	= "";

	if (cate_1 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (cate_2 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (cate_3 == "")
	{
		alert("상품분류를 선택해주세요.");
		return false;
	}

	if (goods_name == "")
	{
		alert("상품명을 입력해주세요.");
		$("#goods_name").focus();
		return false;
	}

	if (goods_small_desc == "")
	{
		alert("상품 요약 설명을 입력해주세요.");
		$("#goods_small_desc").focus();
		return false;
	}

	if (goods_middle_desc == "")
	{
		alert("상품 간략 설명을 입력해주세요.");
		$("#goods_middle_desc").focus();
		return false;
	}

	if (goods_big_desc == "")
	{
		alert("상품 상세 설명을 입력해주세요.");
		$("#goods_big_desc").focus();
		return false;
	}

	if (m_goods_big_descYN == "new")
	{
		m_goods_big_desc		= m_oEditors.getById["m_goods_big_desc"].getIR();
		if (m_goods_big_desc == "")
		{
			alert("모바일 상품 상세 설명을 입력해주세요.");
			$("#m_goods_big_desc").focus();
			return false;
		}
	}

	if (supply_price == "")
	{
		alert("공급가를 입력해주세요.");
		$("#supply_price").focus();
		return false;
	}

	if (sales_price == "")
	{
		alert("판매가를 입력해주세요.");
		$("#sales_price").focus();
		return false;
	}

	if (saved_priceYN == "N")
	{
		saved_price				= $("#saved_price").val();
		if (saved_price == "")
		{
			alert("적립금을 입력해주세요.");
			$("#saved_price").focus();
			return false;
		}
	}

	if (goods_optionYN == "Y")
	{
		for (var i=1; i<=option_num; i++ )
		{
			goods_option_txt			+= "||" + $("#goods_option"+i).val();
		}
		if (goods_option_txt == "")
		{
			alert("상품 옵션을 입력해 주세요.");
			return false;
		}
	}

	if (goods_stock == "")
	{
		alert("재고수량을 입력해주세요.");
		$("#goods_stock").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"						: "update_goods_info",
			"showYN"					: showYN,
			"salesYN"					: salesYN,
			"cate_1"						: cate_1,
			"cate_2"						: cate_2,
			"cate_3"						: cate_3,
			"goods_name"				: goods_name,
			"goods_eng_name"		: goods_eng_name,
			"goods_model"			: goods_model,
			"goods_status"			: goods_status,
			"goods_small_desc"		: goods_small_desc,
			"goods_middle_desc"	: goods_middle_desc,
			"goods_big_desc"		: goods_big_desc,
			"m_goods_big_descYN"	: m_goods_big_descYN,
			"m_goods_big_desc"		: m_goods_big_desc,
			"supply_price"				: supply_price,
			"sales_price"				: sales_price,
			"saved_priceYN"			: saved_priceYN,
			"saved_price"				: saved_price,
			"goods_optionYN"		: goods_optionYN,
			"goods_option_txt"		: goods_option_txt,
			"goods_stock"				: goods_stock,
			"goods_code"				: goods_code,
		},
		success: function(response){
			var res_arr		= response.split("||");
			//goods_code	= goods_code;
			if (res_arr[0]== "Y")
			{
				img_submit();
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

function img_submit()
{
	var frm = $('#img_frm');
	var stringData = frm.serialize();
	frm.ajaxSubmit({
		type: 'post',
		url: '../../lib/filer/php/upload.php?goodscode='+goods_code,
		data: stringData,
		success:function(msg){
			alert(msg);
			alert('상품이 등록 되었습니다');
			self.location.reload();
		}
	}); // end ajaxSubmit
}

// 선택한 상품 삭제
function delete_goods(goods_name,goodscode)
{
	if (confirm(" 상품을 삭제하시겠습니까?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "../../main_exec.php",
			data:{
				"exec"						: "delete_goods_info",
				"goodscode"				: goodscode
			},
			success: function(response){
				if (response == "Y")
				{
					alert("해당 상품이 삭제 되었습니다.");
					location.reload();
				}else{
					alert("시스템 오류. 다시 시도해 주세요.");
					location.reload();
				}
			}
		});
	}
}

// 배너 설정에서 배너 타입 불러오기
function show_select_banner_type(id)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
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
		url    : "../../main_exec.php",
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

// 관리자 로그인 정보 체크
$(document).on("click", ".loginSubmit", function(){
	var admin_id	= $("#admin_id").val();
	var admin_pw	= $("#admin_pw").val();

	if (admin_id == "")
	{
		alert("관리자 아이디를 입력해 주세요.");
		$("#admin_id").focus();
		return false;
	}

	if (admin_pw == "")
	{
		alert("관리자 비밀번호를 입력해 주세요.");
		$("#admin_pw").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"			: "login_admin",
			"admin_id"		: admin_id,
			"admin_pw"	: admin_pw
		},
		success: function(response){
			if (response == "Y")
			{
				location.href	= "../pages/index.php";
			}else{
				alert("아이디 혹은 비밀번호가 틀리셨습니다. 다시 입력해 주세요.");
				return false;
			}
		}
	});
});

// 관리자 생성 정보 체크
$(document).on("click", ".JoinSubmit", function(){
	var admin_id		= $("#admin_id").val();
	var admin_pw		= $("#admin_pw").val();
	var admin_name	= $("#admin_name").val();

	if (admin_id == "")
	{
		alert("관리자 아이디를 입력해 주세요.");
		$("#admin_id").focus();
		return false;
	}

	if (admin_pw == "")
	{
		alert("관리자 비밀번호를 입력해 주세요.");
		$("#admin_pw").focus();
		return false;
	}

	if (admin_name == "")
	{
		alert("관리자 이름을 입력해 주세요.");
		$("#admin_name").focus();
		return false;
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"			: "join_admin",
			"admin_id"		: admin_id,
			"admin_pw"	: admin_pw,
			"admin_name"	: admin_name
		},
		success: function(response){
			if (response == "Y")
			{
				location.href	= "../pages/login.php";
			}else if (response == "D"){
				alert("이미 동일한 아이디가 있습니다. 다른 아이디로 입력해 주세요.");
				return false;
			}else{
				alert("아이디 혹은 비밀번호가 틀리셨습니다. 다시 입력해 주세요.");
				return false;
			}
		}
	});

});

// 배너 구분 선택시 상세내용 설정
$(document).on("change", "#banner_type", function(){
	show_banner_config();
});

