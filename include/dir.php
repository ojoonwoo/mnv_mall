<?
	// 쇼핑몰 메인 폴더 경로
	$_mnv_base_dir						= $_SERVER['DOCUMENT_ROOT']."/";

	// 쇼핑몰 루트폴더
	$_mnv_include_dir_name			= "include";
	$_mnv_admin_dir_name			= "admin";
	$_mnv_js_dir_name					= "js";
	$_mnv_lib_dir_name				= "lib";
	$_mnv_PC_dir_name				= "PC";
	$_mnv_MOBILE_dir_name			= "MOBILE";
	$_mnv_uploads_dir_name			= "uploads";			// 상품 이미지
	$_mnv_uploads2_dir_name		= "uploads2";		// 배너 이미지
	$_mnv_uploads3_dir_name		= "uploads3";		// 이벤트 이미지
	$_mnv_uploads4_dir_name		= "uploads4";		// 포스트 이미지

	// 쇼핑몰 하위 폴더
	$_mnv_board_dir_name			= "board";
	$_mnv_css_dir_name				= "css";
	$_mnv_goods_dir_name			= "goods";
	$_mnv_images_dir_name			= "images";
	$_mnv_member_dir_name			= "member";
	$_mnv_mypage_dir_name			= "mypage";
	$_mnv_upload_dir_name			= "upload";
	$_mnv_order_dir_name			= "order";

	// 쇼핑몰 루트폴더 경로
	$_mnv_include_dir					= $_mnv_base_dir . $_mnv_include_dir_name . "/";
	$_mnv_admin_dir					= $_mnv_base_dir . $_mnv_admin_dir_name . "/";
	$_mnv_js_dir							= $_mnv_base_dir . $_mnv_js_dir_name . "/";
	$_mnv_lib_dir						= $_mnv_base_dir . $_mnv_lib_dir_name . "/";
	$_mnv_PC_dir						= $_mnv_base_dir . $_mnv_PC_dir_name . "/";
	$_mnv_MOBILE_dir					= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/";
	$_mnv_uploads_dir					= $_mnv_base_dir . $_mnv_uploads_dir_name . "/";
	$_mnv_uploads2_dir				= $_mnv_base_dir . $_mnv_uploads2_dir_name . "/";
	$_mnv_uploads3_dir				= $_mnv_base_dir . $_mnv_uploads3_dir_name . "/";
	$_mnv_uploads4_dir				= $_mnv_base_dir . $_mnv_uploads4_dir_name . "/";

	// 쇼핑몰 PC폴더 경로
	$_mnv_PC_board_dir				= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_board_dir_name . "/";
	$_mnv_PC_css_dir					= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_css_dir_name . "/";
	$_mnv_PC_goods_dir				= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_goods_dir_name . "/";
	$_mnv_PC_images_dir				= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_images_dir_name . "/";
	$_mnv_PC_member_dir			= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_member_dir_name . "/";
	$_mnv_PC_member_dir			= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_mypage_dir_name . "/";
	$_mnv_PC_upload_dir				= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_upload_dir_name . "/";
	$_mnv_PC_order_dir				= $_mnv_base_dir . $_mnv_PC_dir_name . "/" . $_mnv_order_dir_name . "/";

	// 쇼핑몰 MOBILE폴더 경로
	$_mnv_MOBILE_board_dir				= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_board_dir_name . "/";
	$_mnv_MOBILE_css_dir					= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_css_dir_name . "/";
	$_mnv_MOBILE_goods_dir				= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_goods_dir_name . "/";
	$_mnv_MOBILE_images_dir			= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_images_dir_name . "/";
	$_mnv_MOBILE_member_dir			= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_member_dir_name . "/";
	$_mnv_MOBILE_member_dir			= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_mypage_dir_name . "/";
	$_mnv_MOBILE_upload_dir			= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_upload_dir_name . "/";
	$_mnv_MOBILE_order_dir				= $_mnv_base_dir . $_mnv_MOBILE_dir_name . "/" . $_mnv_order_dir_name . "/";

	// 쇼핑몰 메인 URL 경로
	$_mnv_base_url						= "http://".$_SERVER['SERVER_NAME']."/";

	// 쇼핑몰 메인 URL 경로
	$_mnv_include_url					= $_mnv_base_url . $_mnv_include_dir_name . "/";
	$_mnv_admin_url					= $_mnv_base_url . $_mnv_admin_dir_name . "/";
	$_mnv_js_url							= $_mnv_base_url . $_mnv_js_dir_name . "/";
	$_mnv_lib_url						= $_mnv_base_url . $_mnv_lib_dir_name . "/";
	$_mnv_PC_url						= $_mnv_base_url . $_mnv_PC_dir_name . "/";
	$_mnv_MOBILE_url					= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/";
	$_mnv_uploads_url					= $_mnv_base_url . $_mnv_uploads_dir_name . "/";
	$_mnv_uploads2_url				= $_mnv_base_url . $_mnv_uploads2_dir_name . "/";
	$_mnv_uploads3_url				= $_mnv_base_url . $_mnv_uploads3_dir_name . "/";
	$_mnv_uploads4_url				= $_mnv_base_url . $_mnv_uploads4_dir_name . "/";

	// 쇼핑몰 PC URL 경로
	$_mnv_PC_board_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_board_dir_name . "/";
	$_mnv_PC_css_url					= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_css_dir_name . "/";
	$_mnv_PC_goods_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_goods_dir_name . "/";
	$_mnv_PC_images_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_images_dir_name . "/";
	$_mnv_PC_member_url			= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_member_dir_name . "/";
	$_mnv_PC_mypage_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_mypage_dir_name . "/";
	$_mnv_PC_upload_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_upload_dir_name . "/";
	$_mnv_PC_order_url				= $_mnv_base_url . $_mnv_PC_dir_name . "/" . $_mnv_order_dir_name . "/";

	// 쇼핑몰 MOBILE URL 경로
	$_mnv_MOBILE_board_url				= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_board_dir_name . "/";
	$_mnv_MOBILE_css_url					= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_css_dir_name . "/";
	$_mnv_MOBILE_goods_url				= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_goods_dir_name . "/";
	$_mnv_MOBILE_images_url			= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_images_dir_name . "/";
	$_mnv_MOBILE_member_url			= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_member_dir_name . "/";
	$_mnv_MOBILE_mypage_url			= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_mypage_dir_name . "/";
	$_mnv_MOBILE_upload_url			= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_upload_dir_name . "/";
	$_mnv_MOBILE_order_url				= $_mnv_base_url . $_mnv_MOBILE_dir_name . "/" . $_mnv_order_dir_name . "/";

?>