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
            <h2>비밀번호 찾기</h2>
            <p>가입시 등록한 이메일로 비밀번호 재설정 메일을 보내드립니다.</p>
          </div>
          <div class="input_login">
            <div class="block_input">
              <input type="text" name="user_id" id="user_id" placeholder="아이디">
            </div>
            <div class="block_input">
              <input type="text" name="user_name" id="user_name" placeholder="이름">
            </div>
            <div class="block_input">
              <input type="text" name="user_email" id="user_email" placeholder="이메일">
            </div>
            <div class="block_input">
              <input type="button" id="sear_pass" value="찾기">
            </div>
          </div>
          <div class="link_btn">
            <a href="<?=$_mnv_MOBILE_member_url?>search_id.php">아이디찾기</a>
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
<script type="text/javascript">
	jQuery(document).ready(function(){
		var sear_pass = $("#sear_pass");
		var user_id = $("#user_id");
		var user_name = $("#user_name");
		var user_email = $("#user_email");

		sear_pass.on('click', function(){
			if(user_id.val() == '') {
				alert("아이디를 입력해주세요.");
				return;
			}
			if(user_name.val() == '') {
				alert("이름을 입력해주세요.");
				return;
			}
			if(user_email.val() == '') {
				alert("이메일을 입력해주세요.");
				return;
			}

			$.ajax({
				type   : "POST",
				async  : false,
				url    : "../../main_exec.php",
				data:{
					"exec"			: "sear_pass",
					"mb_id"			: user_id.val(),
					"mb_name"		: user_name.val(),
					"mb_email"		: user_email.val()
				},
				success: function(response){
					if(response == 'Y'){
						alert("입력하신 메일 주소로 비밀번호 재설정 메일을 보내드렸습니다. 감사합니다.");
						location.href="<?=$_mnv_MOBILE_member_url?>member_login.php";
					}
					else if(response == 'N'){
						alert("입력하신 정보가 맞지 않거나 회원이 아닙니다.");
						user_name.val('');
						user_email.val('');
						user_id.val('').focus();
					}else{
						alert("사용자가 많아 처리가 지연되고 있습니다. 다시 시도해주세요.")
					}
				}
			});
		});
	});
</script>
</html>