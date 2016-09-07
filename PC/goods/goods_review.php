<?
?>
              <form name="frm_execute" method="POST" onsubmit="return checkfrm()">
                <input type="hidden" name="pg" value="<?=$pg?>">
              </form>
              <div class="related_block">
                <p class="head_txt">리뷰</p>
                <table class="pr_view_table">
<?
	$buyer_count_query = "SELECT count(*) FROM ".$_gl['board_review_table']." WHERE goods_code='".$goods_code."'";

	list($buyer_count) = mysqli_fetch_array(mysqli_query($my_db, $buyer_count_query));

	//$buyer_count 여부
	if ($buyer_count > 0)
	{
		$PAGE_CLASS = new Page($pg,$buyer_count,$page_size,$block_size);

		$BLOCK_LIST = $PAGE_CLASS->blockList();
		$PAGE_UNCOUNT = $PAGE_CLASS->page_uncount;
		$buyer_list_query = "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 AND goods_code='".$goods_code."' ORDER BY thread DESC LIMIT $PAGE_CLASS->page_start, $page_size";
		$result = mysqli_query($my_db, $buyer_list_query);

		while ($buyer_data = mysqli_fetch_array($result))
		{
			$buyer_info[] = $buyer_data; 
		}
		foreach($buyer_info as $key => $val)
		{
?>
                  <tr>
                    <td class="num"><?=$PAGE_UNCOUNT--?></td>
                    <td class="subject">
<?
	if($buyer_info[$key]['depth']>0)
	{
?>
                      <img height=1 width="<?=$buyer_info[$key]['depth']*7?>">
<?
	}
?>
                      <a href="http://localhost/mnv_mall/PC/board/read_review.php?idx=<?=$buyer_info[$key]['idx']?>&mb_id=<?=$buyer_info[$key]['user_id']?>&goods_code=<?=$buyer_info[$key]['goods_code']?>&pg=<?=$pg?>">
            <?=$buyer_info[$key]['subject']?>
                      </a>
                    <td class="writer"><?=$buyer_info[$key]['user_id']?></td>
                    <td class="date"><?=substr($buyer_info[$key]['date'],0,10)?></td>
                  </tr>
<?
		}
?>
<?
	}else{
?>
                  <tr>
                    <td class="num">4</td>
                    <td class="subject">[제품 이름] 예뻐요 마음에 들어요!</td>
                    <td class="writer">miniver</td>
                    <td class="date">2016-01-01</td>
                  </tr>
<?
	}
?>

                </table>
                <div class="block_board_btn">
                  <a href="http://localhost/mnv_mall/PC/board/write_review.php?goods_code=<?=$goods_code?>"><input type="button" value="작성하기" class="board_btn" id="write_review"></a>
                  <a href="http://localhost/mnv_mall/PC/board/view_all_review.php"><input type="button" value="목록으로" class="board_btn" id="list_review"></a>
                </div>
                <div class="block_board_pager">
                  <div class="pageing"><?php echo $BLOCK_LIST?></div>
                </div>
              </div>
