<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_MOBILE_url."index.php';</script>";
	}

	$user_id = $_REQUEST['uid'];
	$user_name = $_REQUEST['uname'];
	$user_email = $_REQUEST['uemail'];
?>
  <body>
    <div id="wrap">
<?
	// 사이트 사이드메뉴 영역
	include_once $_mnv_MOBILE_dir."aside.php";
?>
      <div class="container">
<?
	// 사이트 헤더 영역
	include_once $_mnv_MOBILE_dir."header_area.php";
?>
        <div class="contents">
          <div class="title_text">
            <h2>반갑습니다</h2>
            <p>회원가입이 완료되었습니다</p>
          </div>
          <div class="guideBox v2">
            <div class="guideTxt color">
              <p>아이디</p>
              <p>이름</p>
              <p>이메일</p>
            </div>
            <div class="guideTxt color">
              <p>:</p>
              <p>:</p>
              <p>:</p>
            </div>
            <div class="guideTxt">
              <p><?=$user_id?></p>
              <p><?=$user_name?></p>
              <p><?=$user_email?></p>
            </div>
          </div>
          <div class="fullBtn2n">
            <input type="button" value="로그인" class="customBtn" onclick="location.href='<?=$_mnv_MOBILE_member_url?>member_login.php'">
            <input type="button" value="메인으로" onclick="location.href='<?=$_mnv_MOBILE_url?>index.php'">
          </div>
        </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
      </div>
    </div>
  </body>
</html>