<?php
	include_once "../../config.php";
	switch ($_REQUEST['exec'])
	{
		case "show_member_list" :
			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE 1 ORDER BY idx DESC";
			$list_result		= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>아이디</th>";
			$innerHTML	.= "<th>이름</th>";
			$innerHTML	.= "<th>등급</th>";
			$innerHTML	.= "<th>회원가입일시</th>";
			$innerHTML	.= "<th>최종로그인</th>";
			$innerHTML	.= "<th>메일/SMS 발송</th>";
			$innerHTML	.= "<th>정보수정</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$user_id = $list_data['mb_id'];
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td>".$list_data['mb_id']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_name']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_grade']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_join_date']."</td>";
				$innerHTML	.= "<td>".$list_data['mb_login_date']."</td>";
				$innerHTML	.= "<td><input type='button' id='send_mail' onclick='sendMail();' value='메일'>&nbsp;
									<input type='button' id='send_sms' onclick='sendSMS();' value='SMS'></td>";
				$innerHTML	.= "<td><a href='./modify_form.php?userid=".$list_data['mb_id']."'>
										<input type='button' value='수정'><a></td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;
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
			$grade = preg_replace("/\s+/", "", $_POST['grade']);

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

				$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_name='".$username."',mb_birth='".$birth."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_grade='".$grade."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
				$update_result   = mysqli_query($my_db, $update_query);

				if($update_result) {
					$flag = "Y";
				}else{
					$flag = "N";
				}
			echo $flag;
		break;
	}
?>