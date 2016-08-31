<?php
	include_once "config.php";

	switch ($_REQUEST['exec'])
	{
		case "member_login" :
			$mb_id				= $_REQUEST["mb_id"];
			$mb_password	= $_REQUEST["mb_password"];

			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$mb_id."'";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data		= mysqli_fetch_array($login_result);
			// 암호 검증
			if (validate_password($mb_password,$login_data['mb_password']))
			{
				$update_query		= "UPDATE ".$_gl['member_info_table']." SET mb_logindate='".date("Y-m-d H:i:s")."' WHERE mb_id='".$login_data['mb_id']."'";
				$update_result		= mysqli_query($my_db, $update_query);
				// 회원 아이디, 이름 세션 생성
				$_SESSION['ss_chon_id']			= $login_data['mb_id'];
				$_SESSION['ss_chon_name']		= $login_data['mb_name'];
				$flag	= "Y";
			}else{
				$flag	= "N";
			}
			echo $flag;
		break;

		case "member_logout" :
			session_destroy();
		break;

		// 회원가입시 아이디 중복체크
		case "duplicate_check": 

			$input = $_REQUEST['input'];

			$chk_id_query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$input."'";
			$chk_id_result 	= mysqli_query($my_db, $chk_id_query);
			$chk_id_data	= mysqli_num_rows($chk_id_result);

			if($chk_id_data > 0) {
				$flag = "N";
			}else{
				$flag = "Y";
			}
			echo $flag;
		break;

		case "member_join":
			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			$password = create_hash($password);
			$username = preg_replace("/\s+/", "", $_POST['username']);
			$zipcode = $_POST['zipcode'];
			$addr1 = $_POST['addr1'];
			$addr2 = trim($_POST['addr2']);
			$email1 = preg_replace("/\s+/", "", $_POST['email1']);
			$email2 = $_POST['email2'];
			$emailYN = $_POST['emailYN'];
			$tel1 = $_POST['tel1'];
			$tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
			$tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
			$phone1 = $_POST['phone1'];
			$phone2 = $_POST['phone2'];
			$phone3 = $_POST['phone3'];
			$smsYN = $_POST['smsYN'];
			$birthY = preg_replace("/\s+/", "", $_POST['birthY']);
			$birthM = preg_replace("/\s+/", "", $_POST['birthM']);
			$birthD = preg_replace("/\s+/", "", $_POST['birthD']);

			$email = $email1 . '@' . $email2;

			if($tel2 == '') {
				$tel = '';
			}else{
				$tel = $tel1 . '-' . $tel2 . '-' . $tel3;
			} 

				$phone = $phone1 . '-' . $phone2 . '-' . $phone3;

			if($birthY !== '' && $birthM !== '' && $birthD !== '') {
				if($birthM < 10 && strlen($birthM) < 2) {
					$birthM = "/0".$birthM;
				}else{
					$birthM = "/".$birthM;
				}
				if($birthD < 10 && strlen($birthD) < 2) {
					$birthD = "/0".$birthD;
				}else{
					$birthD = "/".$birthD;
				}
			}


				$birth = $birthY . $birthM . $birthD;
				// 등급 수정할것
				$grade = "silver";


				$insert_query    = "INSERT INTO ".$_gl['member_info_table']."(mb_id, mb_password, mb_name, mb_birth, mb_address1, mb_address2, mb_zipcode, mb_telphone, mb_handphone, mb_smsYN, mb_email, mb_emailYN, mb_grade, mb_join_date, mb_join_ipaddr) values('".$user_id."','".$password."','".$username."','".$birth."','".$addr1."','".$addr2."','".$zipcode."','".$tel."','".$phone."','".$smsYN."','".$email."','".$emailYN."','".$grade."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$insert_result   = mysqli_query($my_db, $insert_query);


				// result - 메일 발송
				if($insert_result) {
					$mail_reult = sendMail("ojoonwoo2@gmail.com", "촌의감각", "회원가입을 축하합니다.", "내용", "ojoonwoo@naver.com", "$username");
					$flag = "Y";
				}else{
					$flag = "N";
				}
			echo $flag;

		break;

		case "member_modify":

			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			$username = preg_replace("/\s+/", "", $_POST['username']);
			$zipcode = $_POST['zipcode'];
			$addr1 = $_POST['addr1'];
			$addr2 = trim($_POST['addr2']);
			$email1 = preg_replace("/\s+/", "", $_POST['email1']);
			$email2 = $_POST['email2'];
			$emailYN = $_POST['emailYN'];
			$tel1 = $_POST['tel1'];
			$tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
			$tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
			$phone1 = $_POST['phone1'];
			$phone2 = $_POST['phone2'];
			$phone3 = $_POST['phone3'];
			$smsYN = $_POST['smsYN'];
			$birthY = preg_replace("/\s+/", "", $_POST['birthY']);
			$birthM = preg_replace("/\s+/", "", $_POST['birthM']);
			$birthD = preg_replace("/\s+/", "", $_POST['birthD']);

			$email = $email1 . '@' . $email2;

			if($tel2 == '') {
				$tel = '';
			}else{
				$tel = $tel1 . '-' . $tel2 . '-' . $tel3;
			} 

				$phone = $phone1 . '-' . $phone2 . '-' . $phone3;

				if($birthM !== '' && ($birthM < 10 && strlen($birthM) < 2)) {
					$birthM = "/0".$birthM;
				}else{
					$birthM = "/".$birthM;
				}
				if($birthD !== '' && ($birthD < 10 && strlen($birthD) < 2)) {
					$birthD = "/0".$birthD;
				}else{
					$birthD = "/".$birthD;
				}

				$birth = $birthY . $birthM . $birthD;

				$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_name='".$username."',mb_birth='".$birth."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
				$update_result   = mysqli_query($my_db, $update_query);

				if($update_result) {
					$flag = "Y";
				}else{
					$flag = "N";
				}
			echo $flag;

		break;

// 회원수정시 회원본인인지 체크
		case "member_check":

			$m_id = $_REQUEST['m_id'];
			$m_pw = $_REQUEST['m_pw'];

			$pw_query		= "SELECT mb_id,mb_name,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_smsYN FROM ".$_gl['member_info_table']." WHERE mb_id='".$m_id."' AND mb_password='".$m_pw."'";
			$pw_result		= mysqli_query($my_db, $pw_query);
			$pw_data 		= mysqli_fetch_array($pw_result);
			if($pw_data) {
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;
		break;
}
?>