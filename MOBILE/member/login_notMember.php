<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_MOBILE_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_MOBILE_url."index.php';</script>";
	}
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
            <h2>비회원주문확인</h2>
          </div>
          <div class="input_login">
            <div class="block_input">
              <input type="text" name="nmb_id" id="nmb_id" placeholder="주문자명">
            </div>
            <div class="block_input">
              <input type="password" name="nmb_ordernumer" id="nmb_ordernumer" placeholder="주문번호">
            </div>
            <div class="block_input">
              <input type="button" value="주문확인" onclick="alert('결제모듈 적용할때 같이 작업할 예정');return false;">
            </div>
          </div>
          <div class="fullBtn2n">
            <input type="button" value="로그인" onclick="location.href='<?=$_mnv_MOBILE_member_url?>member_login.php'">
            <input type="button" value="회원가입" onclick="<?=$_mnv_MOBILE_member_url?>join_form.php">
          </div>
        </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
      </div>
    </div>
  </body>
</html>