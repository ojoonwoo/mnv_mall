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
