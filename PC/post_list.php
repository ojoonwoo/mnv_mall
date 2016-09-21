<?
	//include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
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
                <p class="cate_title"><img src="<?=$_mnv_PC_images_url?>cate_title_magzine&chon.png" alt="매거진&촌"></p>
              </div>
            </div>
            <div class="area_main_middle nopadd">
<?
	$post_count_query = "SELECT count(*) FROM ".$_gl['post_info_table']." WHERE 1";

	list($post_count) = mysqli_fetch_array(mysqli_query($my_db, $post_count_query));

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}

	if ($post_count < 8)
		$page_size = $post_count;  // 한 페이지에 나타날 개수
	else
		$page_size = 8;  // 한 페이지에 나타날 개수

	$block_size = 1; // 한 화면에 나타낼 페이지 번호 개수

	$PAGE_CLASS = new Page($pg,$post_count,$page_size,$block_size);

	$BLOCK_LIST = $PAGE_CLASS->blockList7();
	$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
	$post_list_query = "SELECT * FROM ".$_gl['post_info_table']." WHERE 1 ORDER BY idx DESC LIMIT $PAGE_CLASS->page_start, $page_size";
	$result = mysqli_query($my_db, $post_list_query);

	while ($post_data = mysqli_fetch_array($result))
	{
		$post_info[] = $post_data; 
	}

	foreach($post_info as $key => $val)
	{
?>
              <div class="list_magazine">
                <div class="list_inner clearfix">
                  <div class="magazine_img">
                    <a href="<?=$_mnv_PC_url?>post_detail.php?idx=<?=$val['idx']?>"><img src="<?=$val['post_img_url']?>" alt="<?=$val['post_title']?>"></a>
                  </div>
                  <div class="magazine_txt">
                    <a href="<?=$_mnv_PC_url?>post_detail.php?idx=<?=$val['idx']?>">
                      <h3><?=$val['post_title']?>
                        <span class="number">No.<?=$PAGE_UNCOUNT--?></span>
                      </h3>
                      <p><?=$val['post_subtitle']?></p>
                      <p class="date"><?=str_replace("-",".",substr($val['post_regdate'],0,10))?></p>
                    </a>
                  </div>
                </div>
              </div>
<?
	}
?>
              <!-- <div class="block_board_btn">
                <input type="button" value="작성하기" class="board_btn">
                <input type="button" value="문의하기" class="board_btn">
              </div> -->
              <div class="block_board_pager">
                <div class="pageing"><?php echo $BLOCK_LIST?></div>
              </div>
            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="./images/side_full_img1.jpg">
            </div>
          </div>
        </div>
      </div>
      <div id="footer">
        <div class="area_infoChon">
          <div class="inner infoC clearfix">
            <div class="box_info">
              <span class="customerC"><img src="./images/customer_center.png" alt="고객센터"></span>
              <span class="telNum">070-000-0000</span>
              <span>운영시간 10:30-18:00 / 점심시간 13:00-2:30</span>
              <span>신한은행 11-111-11111 예금주 미니버타이징(주)</span>
            </div>
            <div class="box_info">
              <span>이메일 : SERVICE@STORE-CHON.COM</span>
              <span>토/일 법정공휴일, 임시공휴일 전화상담 휴무<br/>Q&A 게시판을 이용해주세요</span>
            </div>
            <div class="box_info clearfix">
              <a href="#"><span class="about_chon"><img src="./images/about_chon.png" alt="about 촌의감각"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_store.png" alt="입점문의"></span></a>
              <a href="#"><span class="sugg"><img src="./images/sugg_partnership.png" alt="제휴문의"></span></a>
              <a href="#"><span class="sugg last"><img src="./images/heavy_buying.png" alt="대량구매"></span></a>
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