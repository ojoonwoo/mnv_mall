<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	$cate_no	= $_REQUEST['cate_no'];
	$cate_info	= select_category_info($cate_no);
	select_cate_best_goods_info($cate_no, $site_option['cate_goods_flag'], 4)
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
	include_once "../cate_navi.php";
	// 베스트셀러 상품 영역
	include_once "./best_cate_goods_area.php";
?>
  <h1><?=$cate_info['cate_name']?></h1>
</body>
</html>