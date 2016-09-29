/*
*
*	PC전용 JS 파일
*
*/

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

//		if(!notice1.checked){
//			alert("1번에 동의하지 않으셨습니다.");
//			return false;
//		}
//		if(!notice2.checked){
//			alert("2번에 동의하지 않으셨습니다.");
//			return false;
//		}
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

function show_sub_cate(cate1, cate2)
{
	sub_cate1	= cate1;
	sub_cate2	= cate2;
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "show_cate_goods_list",
			"cate1"			: cate1,
			"cate2"			: cate2
		},
		success: function(response){
			$("#sort_goods_area").html(response);
		}
	});
}

function show_sub_cate_sort(sort)
{
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "show_cate_goods_list_sort",
			"sort"				: sort,
			"cate1"			: sub_cate1,
			"cate2"			: sub_cate2
		},
		success: function(response){
			$("#sort_goods_area").html(response);
		}
	});

}

// 장바구니 > 수량 증가
function cart_plus(code)
{
	var ins_cnt	= Number($("#"+code+"_cnt").val()) + 1;
	$("#"+code+"_cnt").val(ins_cnt);
	var ins_total_price	= Number($("#"+code+"_current_price").val()) * ins_cnt;
	
	var ins_final_price	= Number($("#hidden_total_price").val()) + Number($("#"+code+"_current_price").val());
	if (ins_final_price > 49999)
		$("#hidden_delivery_price").val("0");

	$("#hidden_total_price").val(ins_final_price);
	$("#"+code+"_total_price").html(numberWithCommas(ins_total_price));
	$(".total_order").html(numberWithCommas(ins_final_price)+"원");
	ins_final_price	= ins_final_price + Number($("#hidden_delivery_price").val());
	$(".total_payment").html(numberWithCommas(ins_final_price)+"원");

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "update_cart_cnt",
			"cart_idx"			: code,
			"goods_cnt"		: ins_cnt
		}
	});
}

// 장바구니 > 수량 감소
function cart_minus(code)
{
	var ins_cnt	= Number($("#"+code+"_cnt").val()) - 1;
	if (ins_cnt < 1)
	{
		alert("최소 주문 수량은 1개입니다.");
		ins_cnt	= 1;
		return false;
	}
	$("#"+code+"_cnt").val(ins_cnt);
	var ins_total_price	= Number($("#"+code+"_current_price").val()) * ins_cnt;
	var ins_final_price	= Number($("#hidden_total_price").val()) - Number($("#"+code+"_current_price").val());
	if (ins_final_price > 49999)
		$("#hidden_delivery_price").val("0");

	$("#hidden_total_price").val(ins_final_price);
	$("#"+code+"_total_price").html(numberWithCommas(ins_total_price));
	$(".total_order").html(numberWithCommas(ins_final_price)+"원");
	ins_final_price	= ins_final_price + Number($("#hidden_delivery_price").val());
	$(".total_payment").html(numberWithCommas(ins_final_price)+"원");

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "../../main_exec.php",
		data:{
			"exec"				: "update_cart_cnt",
			"cart_idx"			: code,
			"goods_cnt"		: ins_cnt
		}
	});
}

// 상품 상세 정보 > 수량 증가
$(document).on("click", "#cnt_plus", function(){
	var ins_cnt	= Number($("#buy_cnt").val()) + 1;
	var ins_total_price	= Number($("#hd_sales_price").val()) * ins_cnt
	$("#buy_cnt").val(ins_cnt);
	$("#total_cnt").html("("+ins_cnt+"개)");
	$("#total_price").html(numberWithCommas(ins_total_price)+"원");
});

// 상품 상세 정보 > 수량 감소
$(document).on("click", "#cnt_minus", function(){
	var ins_cnt	= Number($("#buy_cnt").val()) - 1;
	if (ins_cnt < 1)
	{
		alert("최소 주문 수량은 1개입니다.");
		ins_cnt	= 1;
	}
	var ins_total_price	= Number($("#hd_sales_price").val()) * ins_cnt
	$("#buy_cnt").val(ins_cnt);
	$("#total_cnt").html("("+ins_cnt+"개)");
	$("#total_price").html(numberWithCommas(ins_total_price)+"원");
});

// 금액 3자리마다 콤마 찍기
function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
			"mb_password"	: mb_password
		},
		success: function(response){
			alert(response);
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

$(document).on("keydown", "#mb_password", function(){
	if(event.keyCode == 13)
	{
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
				"mb_password"	: mb_password
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
	}
});

// 회원 로그인
$(document).on("click", "#mb_logout", function(){
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "member_logout"
		},
		success: function(response){
			location.href="http://store-chon.com/PC/index.php";
		}
	});
});

// 장바구니 > 전체선택/해제 체크박스 클릭
$(document).on("click", "#chk_all", function(){
	if($("#chk_all").prop("checked"))
		$("input[name=chk]").prop("checked",true);
	else
		$("input[name=chk]").prop("checked",false);
});

// 장바구니 > 모두삭제 클릭
$(document).on("click", "#cart_all_del", function(){
	if (confirm("장바구니안의 상품을 모두 삭제하시겠습니까?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "http://store-chon.com/main_exec.php",
			data:{
				"exec"				: "delete_all_cart"
			},
			success: function(response){
				if (response == "Y")
				{
					location.reload();
				}else{
					alert("다시 시도해 주세요.");
					location.reload();
				}
			}
		});
	}
});

// 장바구니 > 선택 삭제 클릭
$(document).on("click", "#cart_chk_del", function(){
	var chk_idx	= "";
	$("input[name=chk]:checked").each(function() {
		var chk_id	= $(this).attr("id");
		var chk_arr	= chk_id.split("_");
		chk_idx		+= ","+chk_arr[0];
	});

	if (chk_idx == "")
	{
		alert("선택하신 상품이 없습니다.");
		return false;
	}else{
		if (confirm("장바구니안의 선택하신 상품을 모두 삭제하시겠습니까?"))
		{
			$.ajax({
				type   : "POST",
				async  : false,
				url    : "http://store-chon.com/main_exec.php",
				data:{
					"exec"				: "delete_chk_cart",
					"chk_idx"			: chk_idx
				},
				success: function(response){
					if (response == "Y")
					{
						location.reload();
					}else{
						alert("다시 시도해 주세요.");
						location.reload();
					}
				}
			});
		}
	}
});

// 위시리스트 클릭
$(document).on("click", "#wish_link", function(){
	var goods_idx	= $("#goods_idx").val();
	var goods_optionYN		= $("#goods_optionYN").val();
	var option_txt				= "";
	
	if (goods_optionYN == "Y")
	{
		for (var k=0;k<5 ;k++ )
		{
			if ($("#option_change"+k).val() == "default")
			{
				alert("필수 옵션을 선택해 주세요.");
				return false;
			}else if ($("#option_change"+k).val() == undefined){
				option_txt		+= "";
			}else{
				option_txt		+= "||"+$("#option_change"+k).val();
			}
		}
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "add_wishlist",
			"goods_idx"		: goods_idx,
			"goods_option"	: option_txt
		},
		success: function(response){
			if (response == "N")
			{
				alert("로그인 후 관심상품으로 해주세요.");
				location.href='../member/member_login.php';
			}else if (response == "D"){
				alert("이미 위시리스트에 등록한 상품입니다.");
			}else if (response == "Y"){
				alert("관심상품으로 등록되었습니다.");
			}else{
				alert("다시 시도해 주세요.");
			}
			//location.reload();
		}
	});
});

// 장바구니 클릭
$(document).on("click", "#mycart_link", function(){
	var goods_idx				= $("#goods_idx").val();
	var goods_optionYN		= $("#goods_optionYN").val();
	var option_txt				= "";
	
	if (goods_optionYN == "Y")
	{
		for (var k=0;k<5 ;k++ )
		{
			if ($("#option_change"+k).val() == "default")
			{
				alert("필수 옵션을 선택해 주세요.");
				return false;
			}else if ($("#option_change"+k).val() == undefined){
				option_txt		+= "";
			}else{
				option_txt		+= "||"+$("#option_change"+k).val();
			}
		}
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "add_mycart",
			"goods_idx"		: goods_idx,
			"goods_option"	: option_txt
		},
		success: function(response){
			if (response == "Y")
			{
				$(".popup_basket").show();
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 상품 상세 > 바로구매 클릭
$(document).on("click", "#order_link", function(){
	var goods_idx				= $("#goods_idx").val();
	var goods_optionYN		= $("#goods_optionYN").val();
	var option_txt				= "";
	
	if (goods_optionYN == "Y")
	{
		for (var k=0;k<5 ;k++ )
		{
			if ($("#option_change"+k).val() == "default")
			{
				alert("필수 옵션을 선택해 주세요.");
				return false;
			}else if ($("#option_change"+k).val() == undefined){
				option_txt		+= "";
			}else{
				option_txt		+= "||"+$("#option_change"+k).val();
			}
		}
	}

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "add_mycart",
			"goods_idx"		: goods_idx,
			"goods_option"	: option_txt
		},
		success: function(response){
			if (response == "Y")
			{
				location.href="http://store-chon.com/PC/order/order.php?ordertype=cart"
			}else{
				alert("다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 장바구니 팝업 > 계속 쇼핑하기 클릭
$(document).on("click", "#img_continue_shopping", function(){
	$(".popup_basket").hide();
});

// 장바구니 팝업 > 장바구니보기 클릭
$(document).on("click", "#img_view_basket", function(){
	location.href = "../mypage/mycart.php";
});

// 재입고 요청 클릭
$(document).on("click", ".off_stock", function(){
	var goods_idx	= $("#goods_idx").val();
	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "insert_restock",
			"goods_idx"		: goods_idx
		},
		success: function(response){
			if (response == "Y")
			{
				alert("재입고가 요청 되었습니다.");
			}else if (response == "N"){
				alert("로그인 후 재입고 요청이 가능합니다.");
			}else{
				alert("사용자가 많아 처리가 지연되고 있습니다. 다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 마이페이지 > 관심상품 > 삭제 버튼 클릭
$(document).on("click", ".del_wishlist", function(){
	var goods_idx	= $(this).attr("goods_idx");
	var wish_idx		= $(this).attr("wish_idx");

	if (confirm("관심 목록에서 삭제 할까요?"))
	{
		$.ajax({
			type   : "POST",
			async  : false,
			url    : "http://store-chon.com/main_exec.php",
			data:{
				"exec"				: "delete_wishlist",
				"goods_idx"		: goods_idx,
				"wish_idx"		: wish_idx
			},
			success: function(response){
				if (response == "Y")
				{
					alert("관심목록에서 삭제되었습니다.");
					location.reload();
				}else if (response == "N"){
					alert("로그인 후 가능합니다.");
				}else{
					alert("사용자가 많아 처리가 지연되고 있습니다. 다시 시도해 주세요.");
					location.reload();
				}
			}
		});
	}
});

// 마이페이지 > 관심상품 > 장바구니 클릭
$(document).on("click", ".move_mycart", function(){
	var wish_idx		= $(this).attr("wish_idx");

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "move_mycart",
			"wish_idx"		: wish_idx
		},
		success: function(response){
			console.log(response);
			if (response == "Y")
			{
				location.href = './mycart.php';
			}else{
				alert("사용자가 많아 처리가 지연되고 있습니다. 다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});

// 마이페이지 > 장바구니 > 위시리스트 담기 클릭
$(document).on("click", ".move_wishlist", function(){
	var cart_idx		= $(this).attr("cart_idx");

	$.ajax({
		type   : "POST",
		async  : false,
		url    : "http://store-chon.com/main_exec.php",
		data:{
			"exec"				: "move_wishlist",
			"cart_idx"		: cart_idx
		},
		success: function(response){
			if (response == "Y")
			{
				if (confirm("관심 상품에 상품이 등록되었습니다. 지금 확인하시겠습니까?"))
				{
					location.href = './wishlist.php';
				}
			}else if (response == "D"){
				alert("이미 관심상품에 등록하신 상품입니다..");
			}else{
				alert("사용자가 많아 처리가 지연되고 있습니다. 다시 시도해 주세요.");
				location.reload();
			}
		}
	});
});


// 주문하기 > 주문자 정보와 동일 클릭
$(document).on("click", "#same_order", function(){
	var order_zipcode			= $("#order_zipcode").val();
	var order_name				= $("#order_name").val();
	var order_address1			= $("#order_address1").val();
	var order_address2			= $("#order_address2").val();
	var order_phone1			= $("#order_phone1").val();
	var order_phone2			= $("#order_phone2").val();
	var order_phone3			= $("#order_phone3").val();
	var order_email1			= $("#order_email1").val();
	var order_email2			= $("#order_email2").val();

	$("#deliver_zipcode").val(order_zipcode);
	$("#deliver_name").val(order_name);
	$("#deliver_address1").val(order_address1);
	$("#deliver_address2").val(order_address2);
	$("#deliver_phone1").val(order_phone1);
	$("#deliver_phone2").val(order_phone2);
	$("#deliver_phone3").val(order_phone3);
	$("#deliver_email1").val(order_email1);
	$("#deliver_email2").val(order_email2);
});

// 주문하기 > 새로운 배송지 클릭
$(document).on("click", "#new_address", function(){
	$("#deliver_zipcode").val("");
	$("#deliver_name").val("");
	$("#deliver_address1").val("");
	$("#deliver_address2").val("");
	$("#deliver_phone1").val("");
	$("#deliver_phone2").val("");
	$("#deliver_phone3").val("");
	$("#deliver_email1").val("");
	$("#deliver_email2").val("");
});