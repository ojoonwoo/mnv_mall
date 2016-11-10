<?php
	include_once "config.php";

	switch ($_REQUEST['exec'])
	{
		case "member_login" :
			$mb_id				= $_REQUEST["mb_id"];
			$mb_password	= $_REQUEST["mb_password"];

			$login_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$mb_id."' AND mb_password=MD5('".$mb_password."')";
			$login_result		= mysqli_query($my_db, $login_query);
			$login_data			= mysqli_fetch_array($login_result);

			// 암호 검증
			//if (validate_password($mb_password,$login_data['mb_password']))
			if ($mb_id == $login_data['mb_id'])
			{
				$update_query		= "UPDATE ".$_gl['member_info_table']." SET mb_login_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$login_data['mb_id']."'";
				$update_result		= mysqli_query($my_db, $update_query);
				// 회원 아이디, 이름, 등급 세션 생성
				$_SESSION['ss_chon_id']			= $login_data['mb_id'];
				$_SESSION['ss_chon_name']		= $login_data['mb_name'];
				$_SESSION['ss_chon_grade']		= $login_data['mb_grade'];
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
			//$password = create_hash($password);
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
				$grade = "3";


				$insert_query    = "INSERT INTO ".$_gl['member_info_table']."(mb_id, mb_password, mb_name, mb_birth, mb_address1, mb_address2, mb_zipcode, mb_telphone, mb_handphone, mb_smsYN, mb_email, mb_emailYN, mb_grade, mb_join_date, mb_join_ipaddr) values('".$user_id."',MD5('".$password."'),'".$username."','".$birth."','".$addr1."','".$addr2."','".$zipcode."','".$tel."','".$phone."','".$smsYN."','".$email."','".$emailYN."','".$grade."','".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')";
				$insert_result   = mysqli_query($my_db, $insert_query);


				// result - 메일 발송
				if($insert_result) {
					$mail_result = sendMail(
						"yh.kim@minivertising.kr",
						"촌의감각",
						"회원가입을 축하합니다.",
						"<div style='width: 600px;margin: 0 auto;margin-bottom: 60px;margin-top: 60px;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;;text-align: center'>
						<h2>
						<img src='http://www.store-chon.com/PC/images/mail_title_logo.png' alt='촌의감각' style='width: 116px;height: 92px'/>
						</h2>
						<span style='display: inline-block;width: 18px;height: 1px;background-color: #b88b5b;margin: 15px 0'></span>
						<p style='line-height: 18px;margin-bottom: 18px;font-size: 14px'>
						안녕하세요 촌의 감각 입니다.<br/>
						$username($user_id)고객님의 회원가입을 축하드립니다.<br/>
						회원님의 가입정보는 다음과 같습니다.
						</p>
						<p style='border: 1px solid #b88b5b;width: 334px;margin: 0 auto;margin-bottom: 25px;padding: 25px 0'>
						<span style='display: block;color: #b88b5b;vertical-align: middle;font-size: 15px;letter-spacing: -1px;'>아이디:&nbsp;&nbsp;<span style='color: #b88b5b;letter-spacing: normal;font-weight: bold;'>$user_id</span></span>

						</p>
						<a href='http://www.store-chon.com/' style='text-decoration: none;color: #000'><p style='background-color: #b88b5b;margin: 0 auto;width: 186px;padding: 14px 0'><span style='display: block;color: #fff;vertical-align: middle;font-size: 15px;letter-spacing: -1px'>촌의 감각 홈페이지 가기</span></p></a>
						</div>
						<div style='background-color: #f9f3ec;width: 600px;height: 154px;margin: 0 auto;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;'>
						<div style='padding: 20px 38px;text-align: left;font-size: 12px'>
						<p style='margin: 0;padding-bottom: 4px'>본 메일은 발신전용입니다.</p>
						<p style='margin: 0;padding-bottom: 4px'>기타 관련 사항은 고객센터(070-4888-3580) 또는 촌의 감각 쇼핑몰에서 문의 바랍니다.</p>
						<p style='margin: 0;padding-bottom: 4px;padding-top: 10px'>Copyright@CHON. ALL RIGHTS RESERVED.</p>
						</div>
						</div>
						",
						"$email", "$username");
					$flag = "Y";
				}else{
					$flag = "N";
				}
			echo $flag;

		break;

		case "member_modify":

			$user_id = preg_replace("/\s+/", "", $_POST['user_id']);
			$password = preg_replace("/\s+/", "", $_POST['password']);
			//$password = create_hash($password);
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

			if($birthY != '' && $birthM != '' && $birthD != '') {
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
			
			

			$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password=MD5('".$password."'),mb_name='".$username."',mb_birth='".$birth."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
			$update_result   = mysqli_query($my_db, $update_query);

			if($update_result) {
				$flag = "Y";
			}else{
				$flag = "N";
			}
			echo $flag;

		break;
		
		case "sear_id":
			$mb_name = $_REQUEST['mb_name'];
			$mb_email = $_REQUEST['mb_email'];
			
			$query		= "SELECT mb_id FROM ".$_gl['member_info_table']." WHERE mb_name='".$mb_name."' AND mb_email='".$mb_email."'";
			$result		= mysqli_query($my_db, $query);
			$data 		= mysqli_fetch_array($result);
			
			if($data){
				$replace_id = substr_replace($data['mb_id'], "***", -3);
				$flag = "Y||".$replace_id;
			}else{
				$flag = "N||none";
			}
			
			echo $flag;
			
		break;
			
		case "sear_pass":
			
			$mb_id = $_REQUEST['mb_id'];
			$mb_name = $_REQUEST['mb_name'];
			$mb_email = $_REQUEST['mb_email'];

			$query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$mb_id."' AND mb_name='".$mb_name."' AND mb_email='".$mb_email."'";
			$result		= mysqli_query($my_db, $query);
			$data 		= mysqli_fetch_array($result);

			if($data){
				$temp_pw = PHPRandom::getHexString(20);
				//$password = create_hash($temp_pw);
				$update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password=MD5('".$temp_pw."') WHERE mb_id='".$data['mb_id']."' AND mb_name='".$data['mb_name']."' AND mb_email='".$data['mb_email']."'";
				$update_result   = mysqli_query($my_db, $update_query);
				
				if($update_result)
				{
					$mail_result = sendMail(
						"yh.kim@minivertising.kr",
						"촌의감각",
						"비밀번호가 변경되었습니다.",
						"<div style='width: 600px;margin: 0 auto;margin-bottom: 60px;margin-top: 60px;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;;text-align: center'>
						<h2>
						<img src='http://www.store-chon.com/PC/images/mail_title_logo.png' alt='촌의감각' style='width: 116px;height: 92px'/>
						</h2>
						<span style='display: inline-block;width: 18px;height: 1px;background-color: #b88b5b;margin: 15px 0'></span>
						<p style='line-height: 18px;margin-bottom: 18px;font-size: 14px'>
						새롭게 설정된 비밀번호 입니다.<br/>
						로그인 후, 꼭 재설정 해주세요.
						</p>
						<p style='border: 1px solid #b88b5b;width: 334px;margin: 0 auto;margin-bottom: 25px;padding: 25px 0'>
						<span style='display: block;color: #b88b5b;vertical-align: middle;font-size: 15px;letter-spacing: -1px'>새로 발급된 비밀번호</span>
						<span style='display: block;color: #b88b5b;vertical-align: middle;font-size: 18px;letter-spacing: normal;font-weight: bold;padding-top: 10px'>$temp_pw</span>
						</p>
						<a href='http://store-chon.com/PC/member/member_login.php' style='text-decoration: none;color: #000'><p style='background-color: #b88b5b;margin: 0 auto;width: 186px;padding: 14px 0'><span style='display: block;color: #fff;vertical-align: middle;font-size: 15px;letter-spacing: -1px'>촌의 감각 로그인</span></p></a>
						</div>
						<div style='background-color: #f9f3ec;width: 600px;height: 154px;margin: 0 auto;font-family: &quot;맑은 고딕&quot;, &quot;Malgun Gothic&quot;'>
						<div style='padding: 20px 38px;text-align: left;font-size: 12px'>
						<p style='margin: 0;padding-bottom: 4px'>본 메일은 발신전용입니다.</p>
						<p style='margin: 0;padding-bottom: 4px'>기타 관련 사항은 고객센터(070-4888-3580) 또는 촌의 감각 쇼핑몰에서 문의 바랍니다.</p>
						<p style='margin: 0;padding-bottom: 4px;padding-top: 10px'>Copyright@CHON. ALL RIGHTS RESERVED.</p>
						</div>
						</div>",
						"$mb_email", "$username");
					/*
					if($mail_result == "Y")
						$flag = "Y"; // 메일 발송까지 완료
					else
						$flag = "E"; // 메일 발송 오류
					*/
					$flag = "Y"; // 메일 발송까지 완료
				}else{
					$flag = "E"; // 비밀번호 업데이트 오류
				}
				
			}else{
				$flag = "N"; // 입력한 정보의 회원이 없음
			}

			echo $flag;
			
		break;

// 회원수정시 회원본인인지 체크 --------------------------> 현재 안쓰는 코드
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
			
		case "write_qna":

			$user_id = $_REQUEST['user_id'];
			$goods_code = $_REQUEST['goods_code'];
			$subject = $_REQUEST['subject'];
			$content = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_qna_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_qna_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$goods_code."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

			$i_result = mysqli_query($my_db, $i_query); // 글 저장

			if($i_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "write_mtm":

			$user_id       = $_REQUEST['user_id'];
			$user_email    = $_REQUEST['user_email'];
			$question_type = $_REQUEST['question_type'];
			$subject       = $_REQUEST['subject'];
			$content       = $_REQUEST['content'];

			$s_query = "SELECT max(thread) AS thread, max(idx) FROM ".$_gl['board_mtm_table']."";
			$max_thread_result = mysqli_query($my_db, $s_query);
			$max_thread_fetch = mysqli_fetch_row($max_thread_result);

			$max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;
			$max_idx = $max_thread_fetch[1]+1;

			$i_query = "INSERT INTO ".$_gl['board_mtm_table']."(group_id, thread, depth, user_id, user_email, question_type, subject, content, date, ipaddr)
			VALUES('".$max_idx."','".$max_thread."',0,'".$user_id."','".$user_email."','".$question_type."','".$subject."','".$content."','".date('Y-m-d H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";

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
			
		case "edit_qna":

			$user_id       = $_REQUEST['user_id'];
			$subject       = $_REQUEST['subject'];
			$goods_code = $_REQUEST['goods_code'];
			$content       = $_REQUEST['content'];
			$idx           = $_REQUEST['idx'];

			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
			$u_result = mysqli_query ($my_db, $u_query); // 글 수정
			if($u_result){
				$flag = "Y";
			}else{
				$flag = "N";
			}

			echo $flag;

		break;

		case "edit_mtm":

			$user_id    = $_REQUEST['user_id'];
			$idx	    = $_REQUEST['idx'];
			$subject    = $_REQUEST['subject'];
			$content    = $_REQUEST['content'];
			$question_type = $_REQUEST['question_type'];
			$user_email    = $_REQUEST['user_email'];


			// $s_query = "SELECT max(thread) AS thread FROM ".$_gl['board_review_table']."";
			// $max_thread_result = mysqli_query($my_db, $s_query);
			// $max_thread_fetch = mysqli_fetch_row($max_thread_result);

			// $max_thread = ceil($max_thread_fetch[0]/1000)*1000+1000;

			$u_query = "UPDATE ".$_gl['board_mtm_table']." SET subject='".$subject."', content='".$content."', date='".date('Y-m-d H:i:s')."', question_type='".$question_type."', user_email='".$user_email."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
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
			
		case "reply_qna":

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

			$u_query = "UPDATE ".$_gl['board_qna_table']." SET thread=thread-1 WHERE thread > '".$prev_parent_thread."' AND thread < '".$p_thread."'";
			$result = mysqli_query ($my_db, $u_query); 

			//원본글보다는 1 작은 값으로 답글을 등록한다.
			//원본글의 바로 밑에 등록되게 된다.
			//depth는 원본글의 depth + 1 이다. 원본글이 3(이글도 답글)이면 답글은 4가된다.
			$i_query = "INSERT INTO ".$_gl['board_qna_table']."(group_id, thread, depth, user_id, goods_code, subject, content, date, ipaddr) 
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
			
		case "delete_qna":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";


			$query = "SELECT * FROM ".$_gl['board_qna_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."' AND group_id=";
			// $result = mysqli_query($my_db, $query);
			// $data = mysqli_fetch_array($result);


			if($rows>1)
			{
				$query = "UPDATE ".$_gl['board_qna_table']." SET subject='".$del_subject."', content='".$del_content."', date='".date('Y-m-d H:i:s')."', ipaddr='".$_SERVER['REMOTE_ADDR']."' WHERE idx='".$idx."'";
				$result = mysqli_query($my_db, $query); // 글 수정 (답변글 존재)
			}else{
				$query = "DELETE FROM ".$_gl['board_qna_table']." WHERE idx='".$idx."'";
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
			$buy_cnt			= $_REQUEST['buy_cnt'];
			$mb_id			= $_SESSION['ss_chon_id'];
			$cart_id			= $_SESSION['ss_chon_cartid'];

			if ($mb_id == "")
			{
				$_SESSION['ss_chon_cartid']			= create_cartid();
			}else{
				$_SESSION['ss_chon_cartid']			= $mb_id;
			}

			$cart_query 	= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_id='".$_SESSION['ss_chon_cartid']."' AND goods_idx='".$goods_idx."' AND goods_option='".$goods_option."' AND showYN='Y' AND cart_regdate >= date_add(now(), interval -3 day)";
			$cart_result 	= mysqli_query($my_db, $cart_query);
			$cart_num 	= mysqli_num_rows($cart_result);

			if ($cart_num > 0)
			{
				$cart_data	= mysqli_fetch_array($cart_result);

				$cart_query2		= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt=goods_cnt+".$buy_cnt." WHERE idx='".$cart_data['idx']."'";
				$cart_result2		= mysqli_query($my_db, $cart_query2);
			}else{
				// 추가 수정 작업 해야함
				$cart_query2 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_id, goods_idx, goods_option, goods_cnt, cart_regdate) values('".$_SESSION['ss_chon_cartid']."','".$goods_idx."','".$goods_option."','".$buy_cnt."','".date("Y-m-d H:i:s")."')";
				$cart_result2 	= mysqli_query($my_db, $cart_query2);
			}

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

			$du_cart_query	= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE mb_id='".$wish_data['mb_id']."' AND goods_idx='".$wish_data['goods_idx']."' AND goods_option='".$wish_data['goods_option']."' AND showYN='Y'";
			$du_cart_result	= mysqli_query($my_db, $du_cart_query);
			$du_cart_cnt		= mysqli_num_rows($du_cart_result);

			if ($du_cart_cnt > 0)
			{
				// 장바구니에 같은 상품이 있을 경우에 수량 +1 로직 (임시 제거)
				//$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt=goods_cnt+1 WHERE mb_id='".$wish_data['mb_id']."' AND goods_idx='".$wish_data['goods_idx']."' AND goods_option='".$wish_data['goods_option']."' AND showYN='Y'";
				//$cart_result 		= mysqli_query($my_db, $cart_query);
				$flag	= "D";
			}else{
				$cart_query 	= "INSERT INTO ".$_gl['mycart_info_table']."(mb_id, goods_idx, goods_option, cart_regdate) values('".$mb_id."','".$wish_data['goods_idx']."','".$wish_data['goods_option']."','".date("Y-m-d H:i:s")."')";
				$cart_result 		= mysqli_query($my_db, $cart_query);

				if ($cart_result)
					$flag	= "Y";
				else
					$flag	= "N";
			}

			echo $flag;
		break;

		case "move_wishlist" :
			$cart_idx		= $_REQUEST['cart_idx'];
			$mb_id		= $_SESSION['ss_chon_id'];

			$cart_query		= "SELECT * FROM ".$_gl['mycart_info_table']." WHERE idx='".$cart_idx."'";
			$cart_result		= mysqli_query($my_db, $cart_query);
			$cart_data		= mysqli_fetch_array($cart_result);

			$wish_query		= "SELECT * FROM ".$_gl['wishlist_info_table']." WHERE goods_idx='".$cart_data['goods_idx']."' AND mb_id='".$mb_id."' AND showYN='Y'";
			$wish_result		= mysqli_query($my_db, $wish_query);
			$wish_num		= mysqli_num_rows($wish_result);

			if ($wish_num > 0)
			{
				$flag	= "D";
			}else{
				$wish2_query 	= "INSERT INTO ".$_gl['wishlist_info_table']."(mb_id, goods_idx, goods_option, wish_regdate) values('".$mb_id."','".$cart_data['goods_idx']."','".$cart_data['goods_option']."','".date("Y-m-d H:i:s")."')";
				$wish2_result 		= mysqli_query($my_db, $wish2_query);

				if ($wish2_result)
					$flag	= "Y";
				else
					$flag	= "N";
			}

			echo $flag;
		break;

		case "delete_all_cart" :
			$mb_id		= $_SESSION['ss_chon_id'];
			$direction	= $_REQUEST['direction'];

			if($direction == "cart")
			{
				$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."' AND cart_regdate >= date_add(now(), interval -3 day)";
				$result 		= mysqli_query($my_db, $cart_query);
			}else{
				$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE mb_id='".$mb_id."'";
				$result 		= mysqli_query($my_db, $wish_query);
			}

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;
		break;

		case "delete_chk_cart" :
			$mb_id		= $_SESSION['ss_chon_id'];
			$chk_idx		= $_REQUEST['chk_idx'];
			$direction	= $_REQUEST['direction'];


			$chk_idx_arr		= explode(",",$chk_idx);

			$i = 0;
			foreach($chk_idx_arr as $key => $val)
			{
				if ($i == 0)
				{
					$i++;
					continue;
				}
				
				if($direction == "cart")
				{
					$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET showYN='N' WHERE idx='".$val."' AND mb_id='".$mb_id."'";
					$result 		= mysqli_query($my_db, $cart_query);
					$i++;
				}else{
					$wish_query 	= "UPDATE ".$_gl['wishlist_info_table']." SET showYN='N' WHERE idx='".$val."' AND mb_id='".$mb_id."'";
					$result 		= mysqli_query($my_db, $wish_query);
					$i++;
				}
			}

			if ($result)
				$flag	= "Y";
			else
				$flag	= "N";

			echo $flag;

		break;

		case "update_cart_cnt" :
			$cart_idx		= $_REQUEST['cart_idx'];
			$goods_cnt	= $_REQUEST['goods_cnt'];
			$mb_id		= $_SESSION['ss_chon_id'];

			$cart_query 	= "UPDATE ".$_gl['mycart_info_table']." SET goods_cnt='".$goods_cnt."' WHERE idx='".$cart_idx."' AND mb_id='".$mb_id."'";
			$cart_result 		= mysqli_query($my_db, $cart_query);

		break;

		case "show_cate_goods_list" :
			$cate1			= $_REQUEST['cate1'];
			$cate2			= $_REQUEST['cate2'];
			
			if ($cate2 == "0")
				$where	= "";
			else
				$where	= " AND cate_2='".$cate2."'";

			if ($_SESSION['ss_chon_grade'] == "6")
				$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE cate_1='".$cate1."' ".$where." ORDER BY idx DESC limit 16";
			else
				$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE showYN='Y' AND cate_1='".$cate1."' ".$where." ORDER BY idx DESC limit 16";
			$list_result		= mysqli_query($my_db, $list_query);

			$innerHTML	= "";
			$i = 0;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$list_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$list_data['goods_img_url']);

				if ($list_data['discount_price'] == 0)
					$current_price	= $list_data['sales_price'];
				else
					$current_price	= $list_data['discount_price'];

				$percent_num	= ceil(100 - (($list_data['discount_price'] / $list_data['sales_price'])*100));
				
				if ($i % 4 == 0)
					$innerHTML		.= '<div class="list_product clearfix">';

				$innerHTML		.= '<div class="product n4">';
				$innerHTML		.= '<a href="'.$_mnv_PC_goods_url.'goods_detail.php?goods_code='.$list_data['goods_code'].'"><img src="'.$list_data['goods_img_url'].'" style="width:205px;height:205px"></a>';
				$innerHTML		.= '<div class="prd_info">';
				$innerHTML		.= '<span class="prd_name">'.$list_data['goods_name'].'</span>';
				if ($list_data['sales_price'] != $current_price)
					$innerHTML		.= '<span class="prd_price">'.number_format($list_data['sales_price']).'</span>';
				$innerHTML		.= '<span class="prd_sale" style="display:inline-block;padding-right:0;">'.number_format($current_price).'</span>';
				if ($percent_num < 100)
					$innerHTML		.= '<span class="sale_pctg" style="display:inline-block;padding-left:2px;font-size:13px;color:#00481c;">['.$percent_num.'%]</span>';
				$innerHTML		.= '<span class="prd_desc">'.$list_data['goods_small_desc'].'</span>';
				$innerHTML		.= '</div></div>';

				if ($i == 3 || $i == 7 || $i == 11 || $i == 15)
					$innerHTML		.= '</div>';
				$i++;
			}

			echo $innerHTML;
		break;

		case "show_cate_goods_list_sort" :

			$cate1			= $_REQUEST['cate1'];
			$cate2			= $_REQUEST['cate2'];
			$sort				= $_REQUEST['sort'];

			if ($cate2 == "0")
				$where	= "";
			else
				$where	= " AND cate_2='".$cate2."'";

			$list_query		= "SELECT * FROM ".$_gl['goods_info_table']." WHERE showYN='Y' AND cate_1='".$cate1."' ".$where." ORDER BY ".$sort." limit 16";
			$list_result		= mysqli_query($my_db, $list_query);

			$innerHTML	= "";
			$i = 0;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$list_data['goods_img_url']	= str_replace("../../../",$_mnv_base_url,$list_data['goods_img_url']);

				if ($list_data['discount_price'] == 0)
					$current_price	= $list_data['sales_price'];
				else
					$current_price	= $list_data['discount_price'];
				
				$percent_num	= ceil(100 - (($list_data['discount_price'] / $list_data['sales_price'])*100));
				
				if ($i % 4 == 0)
					$innerHTML		.= '<div class="list_product clearfix">';

				$innerHTML		.= '<div class="product n4">';
				$innerHTML		.= '<a href="'.$_mnv_PC_goods_url.'goods_detail.php?goods_code='.$list_data['goods_code'].'"><img src="'.$list_data['goods_img_url'].'" style="width:205px;height:205px"></a>';
				$innerHTML		.= '<div class="prd_info">';
				$innerHTML		.= '<span class="prd_name">'.$list_data['goods_name'].'</span>';
				if ($list_data['sales_price'] != $current_price)
					$innerHTML		.= '<span class="prd_price">'.number_format($list_data['sales_price']).'</span>';
				$innerHTML		.= '<span class="prd_sale" style="display:inline-block;padding-right:0;">'.number_format($current_price).'</span>';
				if ($percent_num < 100)
					$innerHTML		.= '<span class="sale_pctg" style="display:inline-block;padding-left:2px;font-size:13px;color:#00481c;">['.$percent_num.'%]</span>';
				$innerHTML		.= '<span class="prd_desc">'.$list_data['goods_small_desc'].'</span>';
				$innerHTML		.= '</div></div>';

				if ($i == 3 || $i == 7 || $i == 11 || $i == 15)
					$innerHTML		.= '</div>';
				$i++;
			}
			
			echo $innerHTML;
		break;

		case "insert_order_info" :
			$order_cart_idx				= $_REQUEST['order_cart_idx'];
			$total_order_price			= $_REQUEST['total_order_price'];
			$delivery_price				= $_REQUEST['delivery_price'];
			$total_pay_price			= $_REQUEST['total_pay_price'];
			$order_name				= $_REQUEST['order_name'];
			$order_zipcode				= $_REQUEST['order_zipcode'];
			$order_address1			= $_REQUEST['order_address1'];
			$order_address2			= $_REQUEST['order_address2'];
			$order_phone1				= $_REQUEST['order_phone1'];
			$order_phone2				= $_REQUEST['order_phone2'];
			$order_phone3				= $_REQUEST['order_phone3'];
			$order_phone				= $order_phone1."-".$order_phone2."-".$order_phone3;
			$order_email1				= $_REQUEST['order_email1'];
			$order_email2				= $_REQUEST['order_email2'];
			$order_email				= $order_email1."@".$order_email2;
			$deliver_name				= $_REQUEST['deliver_name'];
			$deliver_zipcode			= $_REQUEST['deliver_zipcode'];
			$deliver_address1			= $_REQUEST['deliver_address1'];
			$deliver_address2			= $_REQUEST['deliver_address2'];
			$deliver_phone1			= $_REQUEST['deliver_phone1'];
			$deliver_phone2			= $_REQUEST['deliver_phone2'];
			$deliver_phone3			= $_REQUEST['deliver_phone3'];
			$deliver_phone				= $deliver_phone1."-".$deliver_phone2."-".$deliver_phone3;
			$deliver_message			= $_REQUEST['deliver_message'];
			$select_pay					= $_REQUEST['select_pay'];
			$cart_id						= $_SESSION['ss_chon_cartid'];
			$order_oid					= "test_".$_REQUEST['order_oid'];
			$show_goods_name		= $_REQUEST['show_goods_name'];

			if ($select_pay == "card_pay")
					$USABLEPAY	= "SC0010";
			else if ($select_pay == "phone_pay")
					$USABLEPAY	= "SC0060";
			else
					$USABLEPAY	= "SC0040";

			$order_query		= "INSERT INTO ".$_gl['order_info_table']."(cart_idx, total_order_price, delivery_price, total_pay_price, order_name, order_zipcode, order_address1, order_address2, order_phone, order_email, deliver_name, deliver_zipcode, deliver_address1, deliver_address2, deliver_phone, deliver_message, select_pay, cart_id, order_oid, order_regdate) values('".$order_cart_idx."','".$total_order_price."','".$delivery_price."','".$total_pay_price."','".$order_name."','".$order_zipcode."','".$order_address1."','".$order_address2."','".$order_phone."','".$order_email."','".$deliver_name."','".$deliver_zipcode."','".$deliver_address1."','".$deliver_address2."','".$deliver_phone."','".$deliver_message."','".$select_pay."','".$cart_id."','".$order_oid."','".date("Y-m-d H:i:s")."')";
			$order_result 		= mysqli_query($my_db, $order_query);

			if ($order_result)
			{
				$flag	= "Y";

				$innerHTML	= "";
				/*
				 * [결제 인증요청 페이지(STEP2-1)]
				 *
				 * 샘플페이지에서는 기본 파라미터만 예시되어 있으며, 별도로 필요하신 파라미터는 연동메뉴얼을 참고하시어 추가 하시기 바랍니다.     
				 */

				/*
				 * 1. 기본결제 인증요청 정보 변경
				 * 
				 * 기본정보를 변경하여 주시기 바랍니다.(파라미터 전달시 POST를 사용하세요)
				 */
				$CST_PLATFORM						= "test";                        //LG유플러스 결제 서비스 선택(test:테스트, service:서비스)
				$CST_MID								= "miniver";                             //상점아이디(LG유플러스으로 부터 발급받으신 상점아이디를 입력하세요)
																							 //테스트 아이디는 't'를 반드시 제외하고 입력하세요.
				$LGD_MID								= (("test" == $CST_PLATFORM)?"t":"").$CST_MID;   //상점아이디(자동생성)
				$LGD_OID								= $order_oid;                             //주문번호(상점정의 유니크한 주문번호를 입력하세요)
				$LGD_AMOUNT							= $total_pay_price;                          //결제금액("," 를 제외한 결제금액을 입력하세요)
				$LGD_BUYER								= $order_name;                           //구매자명
				$LGD_BUYERID							= $cart_id;                           //구매자ID
				$LGD_BUYERADDRESS					= "[".$order_zipcode."] ".$order_address1." ".$order_address2;                           //구매자 주소
				$LGD_BUYERPHONE					= $order_phone;                           //구매자 주소
				$LGD_RECEIVER							= $deliver_name;						// 수취인 이름
				$LGD_RECEIVERPHONE					= $deliver_phone;						// 수취인 전화번호
				$LGD_DELIVERYINFO					= $deliver_message;
				$LGD_PRODUCTINFO					= $show_goods_name;                     //상품명
				$LGD_BUYEREMAIL						= $order_email;                      //구매자 이메일
				$LGD_TIMESTAMP						= date("YmdHis");                                  //타임스탬프
				$LGD_OSTYPE_CHECK					= "P";                                           //값 P: XPay 실행(PC 결제 모듈): PC용과 모바일용 모듈은 파라미터 및 프로세스가 다르므로 PC용은 PC 웹브라우저에서 실행 필요. 
																							 //"P", "M" 외의 문자(Null, "" 포함)는 모바일 또는 PC 여부를 체크하지 않음
				//$LGD_ACTIVEXYN						= "N";											 //계좌이체 결제시 사용, ActiveX 사용 여부로 "N" 이외의 값: ActiveX 환경에서 계좌이체 결제 진행(IE)
																							 
				$LGD_CUSTOM_SKIN					= "red";                                         //상점정의 결제창 스킨
				$LGD_CUSTOM_USABLEPAY			= $USABLEPAY;        	     //디폴트 결제수단 (해당 필드를 보내지 않으면 결제수단 선택 UI 가 노출됩니다.)
				$LGD_WINDOW_VER					= "2.5";										 //결제창 버젼정보
				$LGD_WINDOW_TYPE					= "iframe";					 //결제창 호출방식 (수정불가)
				$LGD_CUSTOM_SWITCHINGTYPE	= "IFRAME";            //신용카드 카드사 인증 페이지 연동 방식 (수정불가)  
				$LGD_CUSTOM_PROCESSTYPE		= "TWOTR";                                       //수정불가

				/*
				 * 가상계좌(무통장) 결제 연동을 하시는 경우 아래 LGD_CASNOTEURL 을 설정하여 주시기 바랍니다. 
				 */    
				$LGD_CASNOTEURL					= "http://store-chon.com/cas_noteurl.php";    

				/*
				 * LGD_RETURNURL 을 설정하여 주시기 바랍니다. 반드시 현재 페이지와 동일한 프로트콜 및  호스트이어야 합니다. 아래 부분을 반드시 수정하십시요.
				 */    
				$LGD_RETURNURL						= "http://store-chon.com/returnurl.php";  


				$configPath								= $_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom";                                  //LG유플러스에서 제공한 환경파일("/conf/lgdacom.conf") 위치 지정.     

				/*
				 *************************************************
				 * 2. MD5 해쉬암호화 (수정하지 마세요) - BEGIN
				 * 
				 * MD5 해쉬암호화는 거래 위변조를 막기위한 방법입니다. 
				 *************************************************
				 *
				 * 해쉬 암호화 적용( LGD_MID + LGD_OID + LGD_AMOUNT + LGD_TIMESTAMP + LGD_MERTKEY )
				 * LGD_MID          : 상점아이디
				 * LGD_OID          : 주문번호
				 * LGD_AMOUNT       : 금액
				 * LGD_TIMESTAMP    : 타임스탬프
				 * LGD_MERTKEY      : 상점MertKey (mertkey는 상점관리자 -> 계약정보 -> 상점정보관리에서 확인하실수 있습니다)
				 *
				 * MD5 해쉬데이터 암호화 검증을 위해
				 * LG유플러스에서 발급한 상점키(MertKey)를 환경설정 파일(lgdacom/conf/mall.conf)에 반드시 입력하여 주시기 바랍니다.
				 */
				require_once($_SERVER['DOCUMENT_ROOT']."/lib/LGU+_XPay_Crossplatform_PHP/lgdacom/XPayClient.php");
				$xpay = &new XPayClient($configPath, $CST_PLATFORM);
				$xpay->Init_TX($LGD_MID);
				$LGD_HASHDATA = md5($LGD_MID.$LGD_OID.$LGD_AMOUNT.$LGD_TIMESTAMP.$xpay->config[$LGD_MID]);
				
				/*
				 *************************************************
				 * 2. MD5 해쉬암호화 (수정하지 마세요) - END
				 *************************************************
				 */

				$payReqMap['CST_PLATFORM']						= $CST_PLATFORM;				// 테스트, 서비스 구분
				$payReqMap['LGD_WINDOW_TYPE']					= $LGD_WINDOW_TYPE;			// 수정불가
				$payReqMap['CST_MID']								= $CST_MID;					// 상점아이디
				$payReqMap['LGD_MID']								= $LGD_MID;					// 상점아이디
				$payReqMap['LGD_OID']								= $LGD_OID;					// 주문번호
				$payReqMap['LGD_BUYER']							= $LGD_BUYER;					// 구매자
				$payReqMap['LGD_BUYERID']							= $LGD_BUYERID;					// 구매자
				$payReqMap['LGD_BUYERADDRESS']				= $LGD_BUYERADDRESS;					// 구매자
				$payReqMap['LGD_BUYERPHONE']					= $LGD_BUYERPHONE;					// 구매자
				$payReqMap['LGD_PRODUCTINFO']					= $LGD_PRODUCTINFO;			// 상품정보
				$payReqMap['LGD_AMOUNT']						= $LGD_AMOUNT;					// 결제금액
				$payReqMap['LGD_BUYEREMAIL']					= $LGD_BUYEREMAIL;				// 구매자 이메일
				$payReqMap['LGD_RECEIVER']						= $LGD_RECEIVER;				// 구매자 이메일
				$payReqMap['LGD_RECEIVERPHONE']				= $LGD_RECEIVERPHONE;				// 구매자 이메일
				$payReqMap['LGD_DELIVERYINFO']					= $LGD_DELIVERYINFO;				// 구매자 이메일
				$payReqMap['LGD_CUSTOM_SKIN']					= $LGD_CUSTOM_SKIN;			// 결제창 SKIN
				$payReqMap['LGD_CUSTOM_PROCESSTYPE']		= $LGD_CUSTOM_PROCESSTYPE;		// 트랜잭션 처리방식
				$payReqMap['LGD_TIMESTAMP']					= $LGD_TIMESTAMP;				// 타임스탬프
				$payReqMap['LGD_HASHDATA']						= $LGD_HASHDATA;				// MD5 해쉬암호값
				$payReqMap['LGD_RETURNURL']					= $LGD_RETURNURL;				// 응답수신페이지
				$payReqMap['LGD_VERSION']						= "PHP_Non-ActiveX_Standard";	// 버전정보 (삭제하지 마세요)
				$payReqMap['LGD_CUSTOM_USABLEPAY']			= $LGD_CUSTOM_USABLEPAY;	// 디폴트 결제수단
				$payReqMap['LGD_CUSTOM_SWITCHINGTYPE']	= $LGD_CUSTOM_SWITCHINGTYPE;// 신용카드 카드사 인증 페이지 연동 방식
				$payReqMap['LGD_OSTYPE_CHECK']				= $LGD_OSTYPE_CHECK;        // 값 P: XPay 실행(PC용 결제 모듈), PC, 모바일 에서 선택적으로 결제가능 
				//$payReqMap['LGD_ACTIVEXYN']					= $LGD_ACTIVEXYN;			// 계좌이체 결제시 사용,ActiveX 사용 여부
				$payReqMap['LGD_WINDOW_VER'] 					= $LGD_WINDOW_VER;
				$payReqMap['LGD_ENCODING'] 						= "UTF-8";
				$payReqMap['LGD_ENCODING_NOTEURL'] 		= "UTF-8";
				$payReqMap['LGD_ENCODING_RETURNURL'] 		= "UTF-8";

				
				// 가상계좌(무통장) 결제연동을 하시는 경우  할당/입금 결과를 통보받기 위해 반드시 LGD_CASNOTEURL 정보를 LG 유플러스에 전송해야 합니다 .
				$payReqMap['LGD_CASNOTEURL'] = $LGD_CASNOTEURL;               // 가상계좌 NOTEURL

				//Return URL에서 인증 결과 수신 시 셋팅될 파라미터 입니다.*/
				$payReqMap['LGD_RESPCODE']           = "";
				$payReqMap['LGD_RESPMSG']            = "";
				$payReqMap['LGD_PAYKEY']             = "";

				$_SESSION['PAYREQ_MAP'] = $payReqMap;

				//$innerHTML .= "<script language='javascript' src='http://xpay.uplus.co.kr/xpay/js/xpay_crossplatform.js' type='text/javascript'></script>";
				$innerHTML .= "<script type='text/javascript'>";
				$innerHTML .= "var LGD_window_type = '".$LGD_WINDOW_TYPE."';";
				$innerHTML .= "";
				$innerHTML .= "function launchCrossPlatform(){lgdwin = openXpay(document.getElementById('LGD_PAYINFO'), '".$CST_PLATFORM."', LGD_window_type, null, '', '');}";
				$innerHTML .= "function getFormObject() {return document.getElementById('LGD_PAYINFO');}";
				$innerHTML .= "function payment_return() {";
				$innerHTML .= "var fDoc;";
				$innerHTML .= "fDoc = lgdwin.contentWindow || lgdwin.contentDocument;";
				$innerHTML .= "if (fDoc.document.getElementById('LGD_RESPCODE').value == '0000') {";
				$innerHTML .= "document.getElementById('LGD_PAYKEY').value = fDoc.document.getElementById('LGD_PAYKEY').value;";
				$innerHTML .= "document.getElementById('LGD_PAYINFO').target = '_self';";
				$innerHTML .= "document.getElementById('LGD_PAYINFO').action = '".$_mnv_PC_order_url."order_complete.php';";
				$innerHTML .= "document.getElementById('LGD_PAYINFO').submit();";
				$innerHTML .= "} else {";
				$innerHTML .= "closeIframe();";
				$innerHTML .= "}}";
				$innerHTML .= "</script>";
				$innerHTML .= "<img src='".$_mnv_PC_images_url."blank.png'>";
				$innerHTML .= "<form method='post' name='LGD_PAYINFO' id='LGD_PAYINFO' action='".$_mnv_PC_order_url."order_complete.php'>";
				foreach ($payReqMap as $key => $value) {
					$innerHTML .= "<input type='hidden' name='$key' id='$key' value='$value'>";
				}
				$innerHTML .= "</form>";

			}else{
				$innerHTML	= "N";
			}

			echo $innerHTML;
		break;
	}
?>