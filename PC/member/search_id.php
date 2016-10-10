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
                  <h3>아이디찾기</h3>
                  <p>
                  아이디를 찾기위해 이름과 가입시<br>
                  등록한 이메일 주소를 넣어주세요.
                  </p>
                  <div class="group_input">
                    <label for="user_name">이름</label>
                    <input type="text" name="user_name" id="user_name" class="mb_input">
                  </div>
                  <div class="group_input">
                    <label for="user_email">이메일</label>
                    <input type="text" name="user_email" id="user_email" class="mb_input">
                  </div>
                  <div class="group_input">
                    <input type="button" class="btn login" id="sear_id" value="확인">
                  </div>
                  <div class="group_input member_action">
                    <a href="<?=$_mnv_PC_member_url?>search_pass.php">비밀번호찾기</a>
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
		var sear_id = $("#sear_id");
		var user_name = $("#user_name");
		var user_email = $("#user_email");
		
		input.on('focus', function(){
			$(this).siblings("label").empty();
		});
		
		sear_id.on('click', function(){
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
					"exec"			: "sear_id",
					"mb_name"		: user_name.val(),
					"mb_email"		: user_email.val()
				},
				success: function(response){
					var resArray = response.split('||');
					if(resArray[0] == 'Y'){
						location.href="./search_id2.php?id="+resArray[1];
					}
					else
					{
						alert("입력하신 정보가 맞지 않거나 회원이 아닙니다.");
						user_email.val('');
						user_name.val('').focus();
					}
				}
			});
		});
	});
</script>
</html>