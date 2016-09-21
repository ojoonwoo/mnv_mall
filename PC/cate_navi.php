            <div class="left_cate">
<?
	$category_info	= select_all_category_info("main");
	$category_cnt	= count($category_info);
	$i = 1;
	foreach($category_info as $key => $val)
	{
?>
              <a href="http://localhost/mnv_mall/PC/goods/list.php?cate_no=<?=$val['idx']?>"><span class="cate_name"><?=$val['cate_name']?></span></a>
<?
		if ($i < $category_cnt)
		{
?>
              <span class="bar1"></span>
<?
		}
		$i++;
	}
?>
            </div>
            <div class="right_cate">
              <a href="<?=$_mnv_PC_url?>post_list.php">
                <span class="cate_name">매거진, 촌</span>
              </a>
              <span class="bar2"></span>
              <a href="<?=$_mnv_PC_url?>event_list.php">
                <span class="cate_name">이벤트</span>
              </a>
              <span class="bar2"></span>
              <a href="#">
                <span class="cate_name">제휴문의</span>
              </a>
            </div>
