<?
/*
*
*	php function 
*
*/


// 상품 코드 테이블에서 새로운 상품코드 가져오기
function create_goodscode()
{
	global $_gl;
	global $my_db;

	$query		= "SELECT goods_code FROM ".$_gl['goodscode_info_table']." WHERE useYN='N' limit 1";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	$query2		= "UPDATE ".$_gl['goodscode_info_table']." SET useYN='Y' WHERE goods_code='".$data['goods_code']."'";
	$result2		= mysqli_query($my_db, $query2);

	return $data['goods_code'];
}

// 해당 상품정보 가져오기 (goods_code)
function select_goods_info($goodscode)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE goods_code='".$goodscode."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

// 해당 카테고리 정보 가져오기 (idx)
function select_category_info($idx)
{
	global $_gl;
	global $my_db;

	$query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE idx='".$idx."'";
	$result		= mysqli_query($my_db, $query);
	$data			= mysqli_fetch_array($result);

	return $data;
}

?>