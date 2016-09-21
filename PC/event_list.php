<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
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
              <li><a href="<?=$_mnv_PC_member_url?>modify_form.php"><span>정보수정</span></a></li>
<?
	}else{
?>
              <li><a href="<?=$_mnv_PC_member_url?>member_login.php"><span>로그인</span></a></li>
              <li><a href="<?=$_mnv_PC_member_url?>join_form.php"><span>회원가입</span></a></li>
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
          <a href="#"><img src="<?=$_mnv_PC_images_url?>logo.jpg"></a>
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
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="area_main_top nopadd">
              <div class="block_title">
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_event.png" alt="이벤트"></p>
              </div>
            </div>
            <div class="area_main_middle nopadd">
<?
	$event_count_query = "SELECT count(*) FROM ".$_gl['event_info_table']." WHERE 1";

	list($event_count) = mysqli_fetch_array(mysqli_query($my_db, $event_count_query));

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}

	if ($event_count < 8)
		$page_size = $event_count;  // 한 페이지에 나타날 개수
	else
		$page_size = 8;  // 한 페이지에 나타날 개수

	$block_size = 1; // 한 화면에 나타낼 페이지 번호 개수

	$PAGE_CLASS = new Page($pg,$event_count,$page_size,$block_size);

	$BLOCK_LIST = $PAGE_CLASS->blockList7();
	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
	$event_list_query = "SELECT * FROM ".$_gl['event_info_table']." WHERE 1 ORDER BY idx DESC LIMIT $PAGE_CLASS->page_start, $page_size";
	$result = mysqli_query($my_db, $event_list_query);

	while ($event_data = mysqli_fetch_array($result))
	{
		$event_info[] = $event_data; 
	}

	$i	= 0;
	foreach($event_info as $key => $val)
	{
		if ($i % 2 == 0)
		{
?>
              <div class="listBox clearfix">
<?
		}
?>
                <div class="eventBox">
                  <div class="boxInImg">
                    <a href="<?=$_mnv_PC_url?>event_detail.php?idx=<?=$val['idx']?>"><img src="<?=$val['event_img_url']?>" alt="<?=$val['event_title']?>"></a>
                  </div>
                  <div class="boxInTxt">
                    <h3><?=$val['event_title']?></h3>
                    <p><?=str_replace("-",".",substr($val['event_startdate'],0,10))?> ~ <?=str_replace("-",".",substr($val['event_enddate'],0,10))?></p>
                  </div>
                </div>
<?
		if ($i % 2 != 0 || $event_count == $i+1)
		{
?>
              </div>
<?
		}
		$i++;
	}
?>
              <div class="block_board_pager pt40">
                <div class="pageing"><?php echo $BLOCK_LIST?></div>
              </div>
            </div>
            <div class="area_main_bottom">
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="<?=$_mnv_PC_images_url?>side_full_img1.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC"><img src="<?=$_mnv_PC_images_url?>customer_center.png" alt="고객센터"></span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon"><img src="<?=$_mnv_PC_images_url?>about_chon.png" alt="about 촌의감각"></span></a>
              <a href="#"><span class="sugg"><img src="<?=$_mnv_PC_images_url?>sugg_store.png" alt="입점문의"></span></a>
              <a href="#"><span class="sugg"><img src="<?=$_mnv_PC_images_url?>sugg_partnership.png" alt="제휴문의"></span></a>
              <a href="#"><span class="sugg last"><img src="<?=$_mnv_PC_images_url?>heavy_buying.png" alt="대량구매"></span></a>
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