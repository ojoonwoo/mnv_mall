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
            <h2>로그인</h2>
          </div>
          <div class="input_login">
            <div class="block_input">
              <input type="text" placeholder="아이디" id="mb_id">
            </div>
            <div class="block_input">
              <input type="password" placeholder="비밀번호" id="mb_password">
            </div>
            <div class="block_input">
              <input type="button" value="로그인" id="mb_login">
            </div>
            <div class="link_btn">
              <a href="<?=$_mnv_MOBILE_member_url?>search_id.php">아이디찾기</a>
              <a href="<?=$_mnv_MOBILE_member_url?>search_pass.php">비밀번호찾기</a>
            </div>
          </div>
          <div class="input_guide">
            <div class="guideTxt">
              <p>아직 회원이 아닌가요?</p>
            </div>
            <div class="guideBtn">
              <input type="button" value="회원가입" onclick="location.href='<?=$_mnv_MOBILE_member_url?>join_form.php'">
            </div>
            <div class="guideTxt">
              <p>비회원으로 주문하셨나요?</p>
            </div>
            <div class="guideBtn">
              <input type="button" value="비회원 주문확인" onclick="location.href='<?=$_mnv_MOBILE_member_url?>login_notMember.php'">
            </div>
          </div>
        </div>
<?
	include_once $_mnv_MOBILE_dir."footer.php";
?>
      </div>
    </div>
  </body>
</html>