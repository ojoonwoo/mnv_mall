<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_PC_url."index.php';</script>";
	}

?>
  <body>
    <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
      <div id="wrap_content">
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="block_input clearfix">
              <div class="area_input member one">
                <div class="area_inner">
                  <h3>비밀번호찾기</h3>
                  <p>
                    가입 시 등록한 이메일로<br>
                    비밀번호 재설정 메일을 보내드립니다.
                  </p>
                  <div class="group_input">
                    <label for="user_id">ID</label>
                    <input type="text" name="user_id" id="user_id" class="mb_input">
                  </div>
                  <div class="group_input">
                    <label for="user_name">이름</label>
                    <input type="text" name="user_name" id="user_name" class="mb_input">
                  </div>
                  <div class="group_input">
                    <label for="user_email">이메일</label>
                    <input type="text" name="user_email" id="user_email" class="mb_input">
                  </div>
                  <div class="group_input">
                    <input type="button" class="btn login" id="sear_pass" value="확인">
                  </div>
                  <div class="group_input member_action">
                    <a href="<?=$_mnv_PC_member_url?>search_id.php">아이디찾기</a>
                    <span class="bar1 short"></span>
                    <a href="<?=$_mnv_PC_member_url?>join_form.php">회원가입</a>
                    <span class="bar1 short"></span>
                    <a href="<?=$_mnv_PC_member_url?>member_login.php">로그인</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="<?=$_mnv_PC_images_url?>side_full.jpg">
            </div>
          </div>
        </div>
      </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
<script>
	jQuery(document).ready(function(){
		var input = $(".mb_input");
		var sear_pass = $("#sear_pass");
		var user_id = $("#user_id");
		var user_name = $("#user_name");
		var user_email = $("#user_email");
		
		input.on('focus', function(){
			$(this).siblings("label").empty();
		});
		
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
					"mb_id"		: user_id.val(),
					"mb_name"		: user_name.val(),
					"mb_email"		: user_email.val()
				},
				success: function(response){
					alert(response);
					if(response == 'Y'){
						alert("입력하신 메일 주소로 비밀번호 재설정 메일을 보내드렸습니다. 감사합니다.");
						location.href="./member_login.php";
					}
					else if(response == 'N'){
						alert("입력하신 정보가 맞지 않거나 회원이 아닙니다.");
						user_name.val('');
						user_email.val('');
						user_id.val('').focus();
					}else{
						alert("사용자가 많아 처리가 지연되고 있습니다 다시 시도해주세요.")
					}
				}
			});
		});
	});
</script>
</html>