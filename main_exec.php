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

			// $id_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$m_id."'";
			// $id_result		= mysqli_query($my_db, $id_query);
			// $id_data = mysqli_fetch_array($id_result);
			// if($id_data) { // 아이디가 있을경우 입력한 비밀번호 검사
			// 	$pw_query		= "SELECT mb_id,mb_name,mb_question,mb_answer,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_gender,mb_smsYN FROM ".$_gl['member_info_table']." WHERE mb_id='".$id_data['mb_id']."' AND mb_password='".$m_pw."'";
			// 	$pw_result		= mysqli_query($my_db, $pw_query);
			// 	$pw_data 		= mysqli_fetch_array($pw_result);
			// 	if($pw_data) {
			// 		echo json_encode($pw_data);
			// 	}else{
			// 		echo json_encode("P");
			// 	}
			// }else{ // 입력한 아이디가 없는경우
			// 	echo json_encode("N");
			// }

		break;

		case "insert_banner_info" :
					$banner_name	= $_REQUEST['banner_name'];
					$banner_type		= $_REQUEST['banner_type'];
					$banner_query	= "INSERT INTO ".$_gl['banner_info_table']."(banner_name,banner_type,banner_regdate) values('".$banner_name."','".$banner_type."','".date("Y-m-d H:i:s")."')";
					$banner_result	= mysqli_query($my_db, $banner_query);
					if($banner_result)
						$flag = "Y";
					else
						$flag = "N";
					echo $banner_query;
				break;

		case "write_review":

			$user_id = $_REQUEST['user_id'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_review_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_review_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_review_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "reply_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];
			$p_thread = $_REQUEST['p_thread'];
			$p_depth = $_REQUEST['p_depth'];
			$parent_gID = $_REQUEST['parent_gID'];

			$prev_parent_thread = ceil($p_thread/1000)*1000 - 1000; // 올림

			//원본글보다는 작고 위값보다는 큰 글들의 thread 값을 모두 1씩 낮춘다.
			//만약 부모글이 2000이면 prev_parent_thread는 1000이므로 2000> x >1000 인 x 글들을 모두 -1 한다.

			$u_query = "UPDATE ".$_gl['board_review_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query); 

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_review_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
						VALUES ('".$parent_gID."','".$p_thread."'-1,'".$p_depth."'+1,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
			$result = mysqli_query($my_db, $i_query);

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "delete_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";


			$query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."' AND group_id=";
			// $result = mysqli_query($my_db, $query);
			// $data = mysqli_fetch_array($result);


			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_review_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 삭제 (답변글 X)
			}

			if($result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;
		break;

		case "add_wishlist" :
			$goods_idx		= $_REQUEST['goods_idx'];
			$goods_option	= $_REQUEST['goods_option'];
			$mb_id			= $_SESSION['ss_chon_id'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인 안되어 있음.
			}else{
				$wish_query 	= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE mb_id='".$mb_id."' AND goods_idx='".$goods_idx."'";
				$wish_result 	= mysqli_query($my_db, $wish_query);
				$wish_data		= mysqli_fetch_array($wish_result);
				if ($wish_data)
				{
					$flag	= "D";
				}else{
					$wish_query2 	= "INSERT INTO ".$_gl['wishlist_info_table']."(mb_id, goods_idx, goods_option, wish_regdate) values('".$mb_id."','".$goods_idx."','".$goods_option."','".date("Y-m-d H:i:s")."')";
					$wish_result2 	= mysqli_query($my_db, $wish_query2);

					if ($wish_result2)
						$flag	= "Y";
					else
						$flag	= "E";
				}
			}
			echo $flag;
		break;

		case "add_mycart" :
			$goods_idx		= $_REQUEST['goods_idx'];
			$goods_option	= $_REQUEST['goods_option'];
			$mb_id			= $_SESSION['ss_chon_id'];
			$cart_id			= $_SESSION['ss_chon_cartid'];

			if ($mb_id == "")
			{
				$_SESSION['ss_chon_cartid']			= create_cartid();
			}else{
				$_SESSION['ss_chon_cartid']			= $mb_id;
			}
			// 추가 수정 작업 해야함
			$cart_query2 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_id, goods_idx, goods_option, cart_regdate) values('".$mb_id."','".$goods_idx."','".$goods_option."','".date("Y-m-d H:i:s")."')";
			$cart_result2 	= mysqli_query($my_db, $cart_query2);

			if ($cart_result2)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "insert_restock" :
			$goods_idx	= $_REQUEST['goods_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인이 안되어 있을 경우
			}else{
				$restock_query2 	= "INSERT INTO ".$_gl['restock_info_table']."(restock_goodsidx, restock_mb_id, restock_regdate) values('".$goods_idx."','".$mb_id."','".date("Y-m-d H:i:s")."')";
				$restock_result2 	= mysqli_query($my_db, $restock_query2);

				if ($restock_result2)
					$flag	= "Y";
				else
					$flag	= "E";
			}

			echo $flag;
		break;

		case "delete_wishlist" :
			$goods_idx	= $_REQUEST['goods_idx'];
			$wish_idx		= $_REQUEST['wish_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			if ($mb_id == "")
			{
				$flag	= "N"; // 로그인이 안되어 있을 경우
			}else{
				$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE idx='".$wish_idx."'";
				$wish_result 	= mysqli_query($my_db, $wish_query);

				if ($wish_result)
					$flag	= "Y";
				else
					$flag	= "E";
			}

			echo $flag;

		break;

		case "move_mycart" :
			$wish_idx		= $_REQUEST['wish_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			$wish_query 	= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE idx='".$wish_idx."'";
			$wish_result 		= mysqli_query($my_db, $wish_query);
			$wish_data		= mysqli_fetch_array($wish_result);

			$cart_query 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_id, goods_idx, goods_option, cart_regdate) values('".$mb_id."','".$wish_data['goods_idx']."','".$wish_data['goods_option']."','".date("Y-m-d H:i:s")."')";
			$cart_result 		= mysqli_query($my_db, $cart_query);

			if ($cart_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "delete_all_cart" :
			$mb_id		= $_SESSION['ss_chon_id'];

			$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."' AND cart_regdate >= date_add(now(), interval -3 day)";
			$cart_result 		= mysqli_query($my_db, $cart_query);

			if ($cart_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "delete_chk_cart" :
			$mb_id		= $_SESSION['ss_chon_id'];
			$chk_idx		= $_REQUEST['chk_idx'];

			$chk_idx_arr		= explode(",",$chk_idx);

			$i = 0;
			foreach($chk_idx_arr as $key => $val)
			{
				if ($i == 0)
				{
					$i++;
					continue;
				}
				$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE idx='".$val."' AND mb_id='".$mb_id."'";
				$cart_result 		= mysqli_query($my_db, $cart_query);
				$i++;
			}

			if ($cart_result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;
	}
?>