<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	if ($_SESSION['ss_chon_id'])
	{
		echo "<script>location.href='".$_mnv_PC_url."index.php';</script>";
	}
?>
  <body>
    <input type="hidden" id="pg_referer" value="<?=$_SERVER['HTTP_REFERER']?>">
    <div id="wrap_page">
<?
	// 사이트 헤더 영역
	include_once $_mnv_PC_dir."header_area.php";
?>
      <div id="wrap_content">
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="block_input clearfix">
              <div class="area_input member">
                 <div class="area_inner">
                   <h3>로그인</h3>
                   <div class="group_input">
                     <label for="user_id">아이디</label>
                     <input type="text" name="mb_id" id="mb_id" class="mb_input autocomplete-off" autocomplete="off">
                   </div>
                   <div class="group_input">
                     <label for="user_pass">비밀번호</label>
                     <input type="password" name="mb_password" id="mb_password" class="mb_input autocomplete-off" autocomplete="off">
                   </div>
                   <div class="group_input">
                     <input type="button" class="btn login" id="mb_login" value="로그인">
                   </div>
                   <div class="group_input member_action">
                     <a href="<?=$_mnv_PC_member_url?>search_id.php">아이디찾기</a>
                     <span class="bar1 short"></span>
                     <a href="<?=$_mnv_PC_member_url?>search_pass.php">비밀번호찾기</a>
                     <span class="bar1 short"></span>
                     <a href="<?=$_mnv_PC_member_url?>join_form.php">회원가입</a>
                   </div>
                 </div>
              </div>
              <div class="area_input nomember">
                <div class="area_inner">
                  <h3>비회원 조회</h3>
                  <div class="group_input">
                    <label for="user_name">이름</label>
                    <input type="text" name="nmb_id" id="nmb_id" class="mb_input">
                  </div>
                  <div class="group_input">
                    <label for="order_number">주문번호</label>
                    <input type="text" name="nmb_ordernumber" id="nmb_ordernumber" class="mb_input">
                  </div>
                  <div class="group_input">
                    <input type="button" class="btn login" value="조회" onclick="alert('결제모듈 적용할때 같이 작업할 예정');return false;">
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
//		setTimeout(function(){
//			$('.autocomplete-off').val('');
//		}, 15);
		var input = $(".mb_input");
		input.on('focus', function(){
			$(this).siblings("label").empty();
		});
	});
</script>
</html>