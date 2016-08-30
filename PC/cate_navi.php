<div>
<?
	$category_info	= select_all_category_info("main");
	foreach($category_info as $key => $val)
	{
?>
  <a href="http://localhost/mnv_mall/PC/goods/list.php?cate_no=<?=$val['idx']?>"><?=$val['cate_name']?></a>
<?
	}
?>
  <a href="#">이벤트</a>
  <a href="#">제휴문의</a>
</div>