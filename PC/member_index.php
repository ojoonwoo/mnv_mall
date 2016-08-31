<?
	include_once "../header.php";
	session_start();
	// $_SESSION['user_id'] = $user_id;
	// $_SESSION['user_id'] = "ojoonwoo";
?>
<body>
<script type="text/javascript">
	$(document).ready(function(){
		$('#modify').on('click', function(){
			var m_id = $('#userid');
			var m_pw = $('#password');

			$.ajax({
				method: 'POST',
				url: '../main_exec.php',
				data: {
					exec            : "member_check",
					m_id            : m_id.val(),
					m_pw            : m_pw.val()
				},
				success: function(res){
					if(res=='Y'){ // 정보 확인 완료
						alert("확인 완료");
						location.href="./modify_form.php";
					}else if(res=='N'){ // 없는 아이디일 경우
						alert("비밀번호가 틀립니다.");
						m_pw.val('').focus();
					}else{
						alert("오류입니다. 다시 시도해주세요.");
					}
				}
			})
		});

		$('#register').on('click', function(){
			location.href="./join_form.php";
		});
	});
</script>
  <h3>회원 가입</h3>
  <input type="button" id="register" value="가입">
  <br><br>
  <h3>회원 정보 수정</h3>
  <strong>아이디 :</strong> <input type="text" id="userid" name="userid" readonly="true" value="<?=$_SESSION['user_id']?>">
  <br><br>
  <strong>비밀번호 :</strong> <input type="password" id="password" name="password">
  <br><br>
  <input type="button" id="modify" value="수정">
</body>
</html>