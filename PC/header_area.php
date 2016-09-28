      <div id="header">
        <div class="area_top">
          <div class="head_bar clearfix">
            <ul class="user_status">
<?
	if ($_SESSION['ss_chon_id'])
	{
?>
              <li><a href="#" id="mb_logout"><span>로그아웃</span></a></li>
              <li><a href="<?=$_mnv_PC_member_url?>modify_form.php"><span>정보수정</span></a></li>
<?
	}else{
?>
              <li><a href="<?=$_mnv_PC_member_url?>member_login.php"><span>로그인</span></a></li>
              <li><a href="<?=$_mnv_PC_member_url?>join_form.php"><span>회원가입</span></a></li>
<?
	}
?>
              <li><a href="<?=$_mnv_PC_mypage_url?>mypage.php"><span>마이페이지</span></a></li>
              <li><a href="<?=$_mnv_PC_mypage_url?>mycart.php"><span>장바구니</span></a></li>
              <li><a href="<?=$_mnv_PC_mypage_url?>order_status.php"><span>주문조회</span></a></li>
              <li><a href="<?=$_mnv_PC_board_url?>list_notice.php"><span>공지사항</span></a></li>
            </ul>
          </div>
        </div>
        <div class="logo_area">
          <a href="<?=$_mnv_PC_url?>index.php?dev=true"><img src="<?=$_mnv_PC_images_url?>logo.png"></a>
        </div>
        <div class="area_nav">
          <div class="nav clearfix">
<?
	// 상단 카테고리 영역
	include_once $_mnv_PC_dir."cate_navi.php";
?>
          </div>
        </div>
      </div>
