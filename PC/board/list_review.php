<?
	include_once $_SERVER['DOCUMENT_ROOT']."/config.php";
	include_once $_mnv_PC_dir."header.php";
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
                <p class="cate_title"><img src="../images/cate_title_review.png" alt="리뷰"></p>
              </div>
            </div>
            <div class="area_main_middle nopadd noborder">
              <div class="block_bg mb10">
                <div class="block_copy alignC fontColor">
                  <p>리뷰 후기 이벤트</p>
                  <p>인스타/블로그</p>
                  <p>적립금 지급(이벤트 내용 설명)</p>
                </div>
              </div>
              
              <div class="table_block wish borderT" id="review_board_area">
               
                <form name="frm_execute" method="POST">
                  <input type="hidden" name="pg" value="<?=$pg?>">
                </form>
                <table class="mypage_board_list padding">
                  <thead>
                    <tr>
                      <th style="width:100px;">번호</th>
                      <th style="width:150px;">썸네일</th>
                      <th style="width:470px;">제목</th>
                      <th style="width:170px;">날짜/작성자</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_review_table']."";

	list($buyer_count) = @mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));


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
	
	if ($buyer_count > 0)
	{

	//$buyer_count 여부

		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList7();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
	//	$buyer_list_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$buyer_list_query = "SELECT board.idx, board.goods_code, board.subject, board.date, board.user_id, goods.goods_img_url FROM ".$_gl['board_review_table']." AS board, ".$_gl['goods_info_table']." AS goods WHERE 1 AND board.goods_code = goods.goods_code AND board.depth=0 ORDER BY board.thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";

		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data;
		}
		foreach($buyer_info as $key => $val)
		{
?>
                    <tr>
                      <td><?=$PAGE_UNCOUNT--;?></td>
                      <td>
                          <img src="<?=$buyer_info[$key]['goods_img_url']?>" width="100" height="100">
                      </td>
                      <td class="subject">
                        <a href="<?=$_mnv_PC_board_url?>read_review.php?idx=<?=$buyer_info[$key]['idx']?>&goods_code=<?=$buyer_info[$key]['goods_code']?>&pg=<?=$pg?>">
                          <p><?=$buyer_info[$key]['subject']?></p>
                        </a>
                      </td>
                      <td>
                        <p><?=substr($buyer_info[$key]['date'],0,10)?></p>
                        <p><?=$buyer_info[$key]['user_id']?></p>
                      </td>
                    </tr>
<?
		}
	}else{
?>
                    <tr>
                      <td colspan="4">게시글이 없습니다.</td>
                    </tr>
<?
	}
?>
                  </tbody>
                </table>
              </div>
              <div class="block_board_pager pt40">
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
