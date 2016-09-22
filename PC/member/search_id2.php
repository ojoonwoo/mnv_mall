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
    <div id="footer">
      <div class="area_infoChon">
        <div class="inner infoC clearfix">
          <div class="box_info">
            <span class="customerC"><img src="../images/customer_center.png" alt="고객센터"></span>
            <span class="telNum">070-000-0000</span>
            <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
            <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
          </div>
          <div class="box_info">
            <span>이메일 : SERVICE@STORE-CHON.COM</span>
            <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
          </div>
          <div class="box_info clearfix">
            <a href="#"><span class="about_chon"><img src="../images/about_chon.png" alt="about 촌의감각"></span></a>
            <a href="#"><span class="sugg"><img src="../images/sugg_store.png" alt="입점문의"></span></a>
            <a href="#"><span class="sugg"><img src="../images/sugg_partnership.png" alt="제휴문의"></span></a>
            <a href="#"><span class="sugg last"><img src="../images/heavy_buying.png" alt="대량구매"></span></a>
          </div>
          <div class="box_info sns clearfix">
            <a href="#"><span>인스타그램</span></a>
            <a href="#"><span>페이스북</span></a>
            <a href="#"><span>블로그</span></a>
          </div>
        </div>
      </div>
      <div class="address">
        <p>company  미니버타이징(주)  address  서울특별시  서초구  방배동  931-9  2F</p>
        <p>owner  양선혜    business  license  114  87  11622   privacy policy | terms of use</p>
        <br>
        <p>@chon all rights reserved</p>
      </div>
    </div>
  </div>
</body>
<script>

</script>
</html>