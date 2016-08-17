<?php
	include_once "config.php";

switch ($_REQUEST['exec'])
{
	case "show_select_grade" :
		$grade_query		= "SELECT * FROM ".$_gl['grade_info_table']."";
		$grade_result		= mysqli_query($my_db, $grade_query);

		$innerHTML	= "<option value=''>선택하세요</option>";
		while ($grade_data	= mysqli_fetch_array($grade_result))
		{
			$innerHTML	.= "<option value='".$grade_data['grade_name']."'>".$grade_data['grade_name']."</option>";
		}

		echo $innerHTML;
	break;

	case "show_select_cate1" :
		$cate1_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_2=0 AND cate_3=0";
		$cate1_result		= mysqli_query($my_db, $cate1_query);

		$innerHTML	= "<option value=''>선택하세요</option>";
		while ($cate1_data	= mysqli_fetch_array($cate1_result))
		{
			$innerHTML	.= "<option value='".$cate1_data['cate_1']."'>".$cate1_data['cate_name']."</option>";
		}

		echo $innerHTML;
	break;

	case "show_select_cate2" :
		$cate_1		= $_REQUEST['cate_1'];
		$cate2_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2<>0 AND cate_3=0";
		$cate2_result		= mysqli_query($my_db, $cate2_query);

		$innerHTML	= "<option value=''>선택하세요</option>";
		while ($cate2_data	= mysqli_fetch_array($cate2_result))
		{
			$innerHTML	.= "<option value='".$cate2_data['cate_2']."'>".$cate2_data['cate_name']."</option>";
		}

		echo $innerHTML;
	break;

	case "insert_cate_info" :
		$cate_name			= $_REQUEST['cate_name'];
		$cate_1					= $_REQUEST['cate_1'];
		$cate_2					= $_REQUEST['cate_2'];
		$cate_3					= $_REQUEST['cate_3'];
		$cate_pcYN				= $_REQUEST['cate_pcYN'];
		$cate_mobileYN		= $_REQUEST['cate_mobileYN'];
		$cate_accessYN		= $_REQUEST['cate_accessYN'];
		$access_specific		= $_REQUEST['access_specific'];
		if ($cate_accessYN == "SPECIFIC")
			$accessYN	= $access_specific;
		else
			$accessYN	= $cate_accessYN;

		if ($cate_1 == "")
		{
			$care1_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1 <> 0 and cate_2 = 0 and cate_3 = 0";
			$care1_result		= mysqli_query($my_db, $care1_query);
			$cate1_num		= @mysqli_num_rows($care1_result);
			$cate_1				= $cate1_num + 1;
		}else{
			if ($cate_2 == "")
			{
				$care2_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2 <> 0 and cate_3 = 0";
				$care2_result		= mysqli_query($my_db, $care2_query);
				$cate2_num		= @mysqli_num_rows($care2_result);
				$cate_2				= $cate2_num + 1;
			}else{
				if ($cate_3 == "")
				{
					$care3_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE cate_1='".$cate_1."' AND cate_2='".$cate_2."' AND cate_3 <> 0";
					$care3_result		= mysqli_query($my_db, $care3_query);
					$cate3_num		= @mysqli_num_rows($care3_result);
					$cate_3				= $cate3_num + 1;
				}
			}
		}
		$cate_query		= "INSERT INTO ".$_gl['category_info_table']."(cate_1, cate_2, cate_3, cate_name, cate_pcYN, cate_mobileYN, cate_accessYN, cate_date) values('".$cate_1."','".$cate_2."','".$cate_3."','".$cate_name."','".$cate_pcYN."','".$cate_mobileYN."','".$accessYN."','".date("Y-m-d H:i:s")."')";
		$cate_result		= mysqli_query($my_db, $cate_query);

		if ($cate_result)
			$flag	= "Y";
		else
			$flag	= "N";

		echo $flag;
	break;

	case "show_category_list" :
		$target	= $_REQUEST['target'];

		$list_query		= "SELECT * FROM ".$_gl['category_info_table']." WHERE 1 ORDER BY cate_1 ASC, cate_2 ASC, cate_3 ASC";
		$list_result		= mysqli_query($my_db, $list_query);

		$innerHTML	= "<tr>";
		$innerHTML	.= "<td>순번</td>";
		$innerHTML	.= "<td>1번 카테고리</td>";
		$innerHTML	.= "<td>2번 카테고리</td>";
		$innerHTML	.= "<td>3번 카테고리</td>";
		$innerHTML	.= "<td>카테고리 명</td>";
		$innerHTML	.= "<td>PC 화면 노출여부</td>";
		$innerHTML	.= "<td>MOBILE 화면 노출여부</td>";
		$innerHTML	.= "<td>카테고리 접속 권한</td>";
		$innerHTML	.= "<td>카테고리 생성 날짜</td>";
		$innerHTML	.= "</tr>";
		$i	= 1;
		while ($list_data = mysqli_fetch_array($list_result))
		{
			$innerHTML	.= "<tr>";
			$innerHTML	.= "<td>".$i."</td>";
			$innerHTML	.= "<td>".$list_data['cate_1']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_2']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_3']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_name']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_pcYN']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_mobileYN']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_accessYN']."</td>";
			$innerHTML	.= "<td>".$list_data['cate_date']."</td>";
			$innerHTML	.= "</tr>";
			$i++;
		}

		echo $innerHTML;
	break;

// 회원가입시 아이디 중복체크
	case "duplicate_check": 

		$type = $_REQUEST['type'];
		$input = $_REQUEST['input'];

		if($type == 'id') {
			$chk_id_query 	= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$input."'";
			$chk_id_result 	= mysqli_query($my_db, $chk_id_query);
			$chk_id_data	= mysqli_num_rows($chk_id_result);

			if($chk_id_data > 0) {
				$flag = "N";
			}else{
				$flag = "Y";
			}
		}
		echo $flag;


	break;

// 회원수정시 회원본인인지 체크
	case "member_check":

		$m_id = $_REQUEST['m_id'];
		$m_pw = $_REQUEST['m_pw'];

		$id_query		= "SELECT * FROM ".$_gl['member_info_table']." WHERE mb_id='".$m_id."'";
		$id_result		= mysqli_query($my_db, $id_query);
		$id_data = mysqli_fetch_array($id_result);
		if($id_data) { // 아이디가 있을경우 입력한 비밀번호 검사
			$pw_query		= "SELECT mb_id,mb_name,mb_question,mb_answer,mb_handphone,mb_telphone,mb_zipcode,mb_address1,mb_address2,mb_birth,mb_email,mb_emailYN,mb_gender,mb_smsYN FROM ".$_gl['member_info_table']." WHERE mb_id='".$id_data['mb_id']."' AND mb_password='".$m_pw."'";
			$pw_result		= mysqli_query($my_db, $pw_query);
			$pw_data 		= mysqli_fetch_array($pw_result);
			if($pw_data) {
				echo json_encode($pw_data);
			}else{
				echo json_encode("P");
			}
		}else{ // 입력한 아이디가 없는경우
			echo json_encode("N");
		} 

	break;
}
?>