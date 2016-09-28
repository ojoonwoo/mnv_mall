<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";

	$user_id = $_SESSION['ss_chon_id'];
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
            <div class="area_main_top nopadd">
              <div class="block_title">
                <p class="cate_title"><img src="../images/cate_title_consult.png" alt="1대1 문의"></p>
              </div>
              <div class="mypage_cate_hori">
                <a href="<?=$_mnv_PC_mypage_dir?>mycart.php"><span>장바구니</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>wishlist.php"><span>관심상품</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>order_status.php"><span>주문조회</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_mypage_dir?>coupon.php"><span>쿠폰</span></a>
                <span class="bar1 short"></span>
                <a href="<?=$_mnv_PC_board_url?>list_mtm.php"><span class="active_underLine">1대1 문의하기</span></a>
                <span class="bar1 short"></span>
                <a href="#"><span>개인정보 수정</span></a>
              </div>
            </div>
            <div class="area_main_middle nopadd">
              <div class="table_block">
               
                <form name="frm_execute" method="POST">
                  <input type="hidden" name="pg" value="<?=$pg?>">
                </form>
                <table class="mypage_board_list">
                  <thead>
                    <tr>
                      <th style="width:296px;">문의 날짜</th>
                      <th style="width:297px;">문의 제목</th>
                      <th style="width:297px;">답변</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_mtm_table']." WHERE user_id='".$user_id."'";

	list($buyer_count) = mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));


	// 리뷰 리스트
	if(isset($_REQUEST['pg']) == false)
	 $pg = "1";
	else
	 $pg = $_REQUEST['pg'];

	if (!$pg) {
	 $pg = "1";
	}

	if ($buyer_count < 10)
	 $page_size = $buyer_count;  // 한 페이지에 나타날 개수
	else
	 $page_size = 10;  // 한 페이지에 나타날 개수

	$block_size = 1; // 한 화면에 나타낼 페이지 번호 개수

	//$buyer_count 여부
	if ($buyer_count > 0)
	{

		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList7();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
		//	$buyer_list_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$buyer_list_query = "SELECT * FROM ".$_gl['board_mtm_table']." WHERE 1 AND user_id='".$user_id."' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";

		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data;
		}
		foreach($buyer_info as $key => $val)
		{
			if($buyer_info[$key]['question_type'] == "shipping")
				$buyer_info[$key]['question_type'] = "[배송]";
			else if($buyer_info[$key]['question_type'] == "payment")
				$buyer_info[$key]['question_type'] = "[결제]";
			else if($buyer_info[$key]['question_type'] == "other")
				$buyer_info[$key]['question_type'] = "[기타]";
			else
				$buyer_info[$key]['question_type'] = "&nbsp;&nbsp;RE:";
?>
                    <tr>
                      <td class="date"><?=substr($buyer_info[$key]['date'],0,10)?></td>
                      <td class="subject">
                        <a href="<?=$_mnv_PC_board_url?>read_mtm.php?idx=<?=$buyer_info[$key]['idx']?>&pg=<?=$pg?>">
                          <?=$buyer_info[$key]['question_type']?>  <?=$buyer_info[$key]['subject']?>
                        </a>
                      </td>
                      <td class="answer"><?=($buyer_info[$key]['answerYN'] == "Y")?"답변완료":"답변대기"?></td>
                    </tr>
<?
		}
	}else{
?>
                  <tr>
                    <td colspan="3">게시글이 없습니다.</td>
                  </tr>
<?
	}
?>
                </tbody>
              </table>
              </div>
              <div class="block_board_btn">
                <a href="<?=$_mnv_PC_board_url?>write_mtm.php">
                  <input type="button" value="문의하기" class="board_btn">
                </a>
              </div>
              <div class="block_board_pager">
                <div class="pageing"><?php echo $BLOCK_LIST?></div>
              </div>
            </div>
            <div class="area_main_bottom">

            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="../images/side_full_img1.jpg">
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
	function pageRun(num)
	{
		$('#review_board_area').load(function(){
			f = document.frm_execute;
			f.pg.value = num;
			f.submit();
		}).fadeIn("slow");
	}
</script>
</html>
