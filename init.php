<?
	include_once "config.php";

	$bring_banner_query 	= "SELECT * FROM ".$_gl['banner_info_table']." WHERE ban_showYN='Y' AND ban_device='PC' AND ban_type='move_main' ORDER BY ban_regdate DESC limit 1";
	$banner_result 			= mysqli_query($my_db, $bring_banner_query);
	$banner_data			= mysqli_fetch_array($banner_result);

	$banner_img_url1 = $banner_data['ban_img_url1'];
	$banner_img_url2 = $banner_data['ban_img_url2'];
	$banner_img_url3 = $banner_data['ban_img_url3'];


	echo $banner_img_url1."||".$banner_img_url2."||".$banner_img_url3;
?>