<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_MOBILE_url."index.php';</script>";
	}

	$mb_id = $_REQUEST['id'];
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
            <h2>아이디 찾기</h2>
            <p>가입시 등록한 아이디는 아래와 같습니다</p>
          </div>
          <div class="input_login">
            <div class="guideBox">
              <p><?=$mb_id?></p>
            </div>
          </div>
          <div class="fullBtn2n">
            <input type="button" value="로그인" onclick="location.href='<?=$_mnv_MOBILE_member_url?>member_login.php'">
            <input type="button" value="회원가입" onclick="location.href='<?=$_mnv_MOBILE_member_url?>join_form.php'">
          </div>
        </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
      </div>
    </div>
  </body>
</html>