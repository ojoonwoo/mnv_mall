<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";
	print_r($_SERVER['DOCUMENT_ROOT']);
	if ($_REQUEST['dev'] != true)
	{
		echo "작업중입니다...";
		exit;
	}
?>
  <body>
    <div id="wrap_page">
      <div id="header">
        <div class="area_top">
          <div class="head_bar clearfix">
            <ul class="user_status">
<?
	if ($_SESSION['ss_chon_id'])
	{
?>
              <li><a href="#" id="mb_logout"><span>로그아웃</span></a></li>
              <li><a href="<?=$_mnv_PC_member_dir?>modify_form.php"><span>정보수정</span></a></li>
<?
	}else{
?>
              <li><a href="<?=$_mnv_PC_member_dir?>member_login.php"><span>로그인</span></a></li>
              <li><a href="<?=$_mnv_PC_member_dir?>join_form.php"><span>회원가입</span></a></li>
<?
	}
?>
              <li><a href="#"><span>마이페이지</span></a></li>
              <li><a href="#"><span>장바구니</span></a></li>
              <li><a href="#"><span>주문조회</span></a></li>
            </ul>
          </div>
        </div>
        <div class="logo_area">
          <a href="#"><img src="<?=$_mnv_PC_images_dir?>logo.jpg"></a>
        </div>
        <div class="area_nav">
          <div class="nav clearfix">
<?
	// 상단 카테고리 영역
	include_once $_mnv_PC_dir."cate_navi.php";
?>
          </div>
        </div>
      </div>
      <div id="wrap_content">
        <div class="contents">
<?
	// 배너 영역
	include_once $_mnv_PC_dir."banner_area.php";

	// 베스트셀러 상품 영역
	include_once $_mnv_PC_dir."best_goods_area.php";

	// 신 상품 영역
	include_once $_mnv_PC_dir."new_goods_area.php";

	// 기획 상품 영역
	include_once $_mnv_PC_dir."plan_goods_area.php";
?>
          <div class="area_list_title">
            <span class="list_title no_line">인스타그램 @chon.life</span>
          </div>
          <div class="area_insta">
            <div class="inner insta clearfix" id="instafeed">
              <!-- <div class="insta_box"><a href="#"><img src="./images/insta1.jpg"></a></div>
              <div class="insta_box"><a href="#"><img src="./images/default_insta.jpg"></a></div>
              <div class="insta_box"><a href="#"><img src="./images/default_insta.jpg"></a></div>
              <div class="insta_box"><a href="#"><img src="./images/default_insta.jpg"></a></div>
              <div class="insta_box"><a href="#"><img src="./images/default_insta.jpg"></a></div> -->
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC">고객센터</span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon">ABOUT 촌의감각</span></a>
              <a href="#"><span class="sugg">입점문의</span></a>
              <a href="#"><span class="sugg">제휴문의</span></a>
              <a href="#"><span class="sugg last">대량구매</span></a>
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
</html>
<script>
$(document).ready(function() {
	$('.banner_slide').bxSlider({
		pager: true,
		controls:false,
		slideWidth: 500,
		autoControls: false,
		auto: true,
		infiniteLoop: true
	});
});
/*
    var feed = new Instafeed({
        get: 'user',
        userId: '67d6dbceac9d4e58a6eb002db2b84b05',
		sortBy:'most-recent',
		limit:20,
		template:'',
		accessToken:
    });
    feed.run();
*/
</script>
