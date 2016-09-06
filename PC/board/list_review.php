<?
	include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
	include_once $_mnv_PC_dir."header.php";

	if(isset($_REQUEST['pg']) == false)
		$pg = "1";
	else
		$pg = $_REQUEST['pg'];

	if (!$pg) {
		$pg = "1";
	}
	//if(isset($pg) == false) $pg = 1;  // $pg가 없으면 1로 생성
	$page_size = 10;  // 한 페이지에 나타날 개수
	$block_size = 10; // 한 화면에 나타낼 페이지 번호 개수

?>
<body>
  <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
    <input type="hidden" name="pg" value="<?=$pg?>">
  </form>
  <table id="review_list" class="table table-hover">
    <thead>
      <tr>
        <th>No.</th>
        <th>subject</th>
        <th>date/writer</th>
        <th>hit</th>
      </tr>
    </thead>
    <tbody>
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_review_table']." WHERE goods_code='test1111'";

	list($buyer_count) = mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));

	//$buyer_count 여부
	if ($buyer_count > 0)
	{
		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
		$buyer_list_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 AND goods_code='test1111' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$result = mysqli_query($my_db, $buyer_list_query);

		//
		// $result_count = mysqli_query("SELECT count(*) FROM ".$_gl['board_review_table']."", $my_db);
		// $result_row = mysqli_fetch_row($result_count);
		// $total_row = $result_row[0];


		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data; 
		}
		foreach($buyer_info as $key => $val)
		{
?>
      <tr>
        <td><?=$PAGE_UNCOUNT--?></td> <!-- No. 하나씩 감소 -->
          <td>
          <? if($buyer_info[$key]['depth']>0) { ?>
            <img height=1 width="<?=$buyer_info[$key]['depth']*7?>">
          <? } ?>
            <a href="read_review.php?idx=<?=$buyer_info[$key]['idx']?>&id=<?=$buyer_info[$key]['user_id']?>&code=<?=$buyer_info[$key]['goods_code']?>&pg=<?=$pg?>">
            <?=$buyer_info[$key]['subject']?>
            </a>
        </td>
        <td><?=$buyer_info[$key]['date']?><br>
          <?=$buyer_info[$key]['user_id']?>
        </td>
        <td><?=$buyer_info[$key]['hit']?></td>
      </tr>
<?
	}
?>
      <tr>
        <td colspan="4"><div class="pageing"><?php echo $BLOCK_LIST?></div></td>
      </tr>
      <tr>
        <td colspan="4">
          <!-- <a href="write_review.php?id=ojoonwoo&code=test1111">WRITE</a> -->
          <a href="write_review.php">WRITE</a>
          /<a href="view_all_review.php"> VIEW ALL</a>
        </td>
      </tr>
<?
	}else{
?>
      <tr>
        <td colspan="4">게시글이 없습니다.</td>
      </tr>
      <tr>
        <td colspan="4" align="right">
          <a href="write_review.php?id=ojoonwoo&code=test1111">WRITE</a>
          /<a href="view_all_review.php"> VIEW ALL</a>
        </td>
      </tr>
<?
	}
?>
    </tbody>
  </table>
</body>
</html>
<script type="text/javascript">
	function pageRun(num)
	{
		f = document.frm_execute;
		f.pg.value = num;
		f.submit();
	}
</script>