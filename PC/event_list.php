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
<?
	include_once $_mnv_PC_dir."footer.php";
?>
    </div>
  </body>
</html>