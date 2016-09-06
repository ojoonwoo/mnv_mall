<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	//print_r($_SESSION);
?>
<body>
  <div id="header_area">
    <a href="http://localhost/mnv_mall/PC/index.php">촌의 감각</a>
<?
	if ($_SESSION['ss_chon_id'])
	{
?>
    <a href="#" id="mb_logout">로그아웃</a>
    <a href="http://localhost/mnv_mall/PC/member/modify_form.php">정보수정</a>
<?
	}else{
?>
    <a href="http://localhost/mnv_mall/PC/member/member_login.php">로그인</a>
    <a href="http://localhost/mnv_mall/PC/member/join_form.php">회원가입</a>
<?
	}
?>
    <a href="#">마이페이지</a>
    <a href="#">장바구니</a>
    <a href="#">주문조회</a>
    <a href="#">매거진 촌</a>
    <a href="#">인스타그램</a>
  </div>
<?
	// 상단 카테고리 영역
	include_once $_mnv_PC_dir."cate_navi.php";
	// 배너 영역
	include_once $_mnv_PC_dir."banner_area.php";
	// 베스트셀러 상품 영역
	include_once $_mnv_PC_dir."best_goods_area.php";
	// 신 상품 영역
	include_once $_mnv_PC_dir."new_goods_area.php";
	// 기획 상품 영역
	include_once $_mnv_PC_dir."plan_goods_area.php";
?>
</body>
</html>
<script>
$(document).ready(function() {
	$('.slide_banner').bxSlider({
		pager: true,
		controls:false,
		slideWidth: 500,
		autoControls: false,
		auto: true,
		infiniteLoop: true
	});
});
</script>
