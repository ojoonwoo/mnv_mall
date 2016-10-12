<?php
	session_save_path($_SERVER['DOCUMENT_ROOT']."/session");
	ini_set("session.cache_expire", 180); // 세션 유효시간 : 분
	ini_set("session.gc_maxlifetime", 180); // 세션 가비지 컬렉션(로그인시 세션지속 시간) :
	session_start();
//	session_destroy();
	header("Content-Type: text/html; charset=UTF-8");
	//환경설정 파일
	include_once "include/global.php"; 				//변수정보
	include_once "include/function.php"; 				//함수정보
	include_once "include/dbi.php"; 					//DB 연결정보
	include_once "include/dir.php"; 						//경로정보
	include_once "include/pbkdf2.compat.php"; 	//암호화
	//include_once "include/passwordstorage.php"; 	//암호화
	include_once "include/PHPMailer/PHPMailerAutoload.php";			//MAIL 클래스
	include_once "include/page.class.php";		//페이징 처리 CLASS
	include_once "include/phprandom.php";		//난수번호 생성 CLASS

	mysqli_query ($my_db,"set names utf8");


	// 모바일 체크
	$mobile_agent = array("iPhone","iPod","iPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
	$check_mobile = "N";
	for($i=0; $i<sizeof($mobile_agent); $i++){
		if(stripos( $_SERVER['HTTP_USER_AGENT'], $mobile_agent[$i] )){
			$check_mobile = "Y";
			break;
		}
	}

	if($check_mobile == "Y")
		$gubun = "MOBILE";
	else
		$gubun = "PC";

	// 사이트 기본 옵션 불러오기
	$site_option	= load_option();
?>
