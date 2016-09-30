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
      </div>
      <div id="wrap_content">
        <div class="contents l2 clearfix">
          <div class="section main">
            <div class="area_main_top nopadd">
              <div class="block_title">
                <p class="cate_title"><img src="../images/cate_title_notice.png" alt="알려드립니다"></p>
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
                      <th style="width:80px;">번호</th>
                      <th style="width:500px;">제목</th>
                      <th style="width:150px;">작성자</th>
                      <th style="width:160px;">날짜</th>
                    </tr>
                  </thead>
                  <tbody>
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_notice_table']."";

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
		$buyer_list_query = "SELECT * FROM ".$_gl['board_notice_table']." WHERE 1 AND showYN='Y' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";

		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = @mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data;
		}
		foreach($buyer_info as $key => $val)
		{
?>
                    <tr>
                      <td class="no"><?=$buyer_info[$key]['idx']?></td>
                      <td class="subject">
                        <a href="<?=$_mnv_PC_board_url?>read_notice.php?idx=<?=$buyer_info[$key]['idx']?>&pg=<?=$pg?>">
                        <?=$buyer_info[$key]['subject']?>
                        </a>
                      </td>
                      <td class="writer"><?=$buyer_info[$key]['user_id']?></td>
                      <td class="date"><?=substr($buyer_info[$key]['date'],0,10)?></td>
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
              <div class="block_board_pager mt15">
                <div class="pageing"><?php echo $BLOCK_LIST?></div>
              </div>
            </div>
            <div class="area_main_bottom">

            </div>
          </div>
          <div class="section side">
            <div class="side_full_img">
              <img src="../images/side_full.jpg">
            </div>
          </div>
        </div>
      </div>
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
</html>
<script type="text/javascript">
	function pageRun(num)
	{
		//$('#review_board_area').load(function(){
			f = document.frm_execute;
			f.pg.value = num;
			f.submit();
		//}).fadeIn("slow");
	}

</script>