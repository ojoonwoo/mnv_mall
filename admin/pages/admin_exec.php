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

		case "show_review_list":

			$target	= $_REQUEST['target'];
			$list_query		= "SELECT * FROM ".$_gl['board_review_table']." WHERE 1 ORDER BY thread DESC";
			$list_result	= mysqli_query($my_db, $list_query);
			$innerHTML	= "<thead>";
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<th><input type='checkbox' name='all_check' id='all_check'></th>";
			$innerHTML	.= "<th>순번</th>";
			$innerHTML	.= "<th>상품코드</th>";
			$innerHTML	.= "<th>제목</th>";
			$innerHTML	.= "<th>작성자</th>";
			$innerHTML	.= "<th>작성일시</th>";
			$innerHTML	.= "<th>조회수</th>";
			$innerHTML	.= "<th>답변</th>";
			$innerHTML	.= "</tr>";
			$innerHTML	.= "</thead>";
			$innerHTML	.= "<tbody>";
			//$i	= 1;
			while ($list_data = mysqli_fetch_array($list_result))
			{
				$innerHTML	.= "<tr>";
				$innerHTML	.= "<td><input type='checkbox' name='one_check' id='one_check'></td>";
				$innerHTML	.= "<td></td>";
				$innerHTML	.= "<td>".$list_data['goods_code']."</td>";
				$innerHTML	.= "<td>";
				if($list_data['depth']>0)
				{
					$depth = $list_data['depth']*7;
					$innerHTML	.= "<img height='1' width=$depth>";
				}
				$innerHTML	.= "<a href='./read_review.php?idx=".$list_data['idx']."'>
									".$list_data['subject']."
									</td>";
				$innerHTML	.= "<td>".$list_data['user_id']."</td>";
				$innerHTML	.= "<td>".$list_data['date']."</td>";
				$innerHTML	.= "<td>".$list_data['hit']."</td>";
				$innerHTML	.= "<td>
									<a href='./reply_review.php?idx=".$list_data['idx']."'>
									<input type='button' value='답변'></a>
									<a href='./delete_review.php?idx=".$list_data['idx']."'>
									<input type='button' value='삭제'></a>
								</td>";
				$innerHTML	.= "</tr>";
				//$i++;
			}
			$innerHTML	.= "</tbody>";
			echo $innerHTML;

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

		case "delete_review":

			$user_id = $_REQUEST['user_id'];
			$idx	 = $_REQUEST['idx'];
			$group_id	 = $_REQUEST['group_id'];
			$goods_code = $_REQUEST['goods_code'];

			$del_subject = "삭제된 글입니다.";
			$del_content = "삭제된 글입니다.";

			// 모든 글에서의 내용 뽑아내서 치환할경우
			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE idx = '".$idx."'";
			// $result = mysqli_query($my_db, $query);
			// $target = mysqli_fetch_array($result); // 지울 제목, 내용

			// $query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			// $result = mysqli_query($my_db, $query);
			// while ($array = mysqli_fetch_array($result)) {
			// 	$contentArr[][] = str_replace($target['content'], $del_content, $array['content']);
			// }
			// print_r($contentArr);
		
			$query = "SELECT * FROM ".$_gl['board_review_table']." WHERE group_id = '".$group_id."'";
			$result = mysqli_query($my_db, $query);
			$rows = mysqli_num_rows($result);

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
	}

?>