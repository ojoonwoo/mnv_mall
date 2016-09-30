<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$mb_id = $_REQUEST['id'];
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
                  고객님의 아이디입니다.
                </p>
                <div class="group_input borderBox">
                  <p>아이디: <span><?=$mb_id?></span></p>
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

</script>
</html>