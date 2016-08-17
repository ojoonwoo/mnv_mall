<?
include_once "../header.php";
?>
<body>
<? 
  print_r($_POST);
  $user_id = preg_replace("/\s+/", "", $_POST['userid']);
  $password = preg_replace("/\s+/", "", $_POST['password']);
  $password_Q = $_POST['password_Q'];
  $password_A = trim($_POST['password_A']);
  $username = preg_replace("/\s+/", "", $_POST['username']);
  $zipcode = $_POST['zipcode'];
  $addr1 = $_POST['addr1'];
  $addr2 = trim($_POST['addr2']);
  $tel1 = $_POST['tel1'];
  $tel2 = preg_replace("/\s+/", "", $_POST['tel2']);
  $tel3 = preg_replace("/\s+/", "", $_POST['tel3']);
  $phone1 = $_POST['phone1'];
  $phone2 = preg_replace("/\s+/", "", $_POST['phone2']);
  $phone3 = preg_replace("/\s+/", "", $_POST['phone3']);
  $smsYN = $_POST['smsYN'];
  $email = preg_replace("/\s+/", "", $_POST['email1']);
  $emailYN = $_POST['emailYN'];
  $birthY = preg_replace("/\s+/", "", $_POST['birthY']);
  $birthM = preg_replace("/\s+/", "", $_POST['birthM']);
  $birthD = preg_replace("/\s+/", "", $_POST['birthD']);
  $gender = $_POST['gender'];
  $type = $_POST['type'];
  $grade = $_POST['grade'];

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
  // 등급 수정할것

    $update_query = "UPDATE ".$_gl['member_info_table']." SET mb_password='".$password."',mb_question='".$password_Q."',mb_answer='".$password_A."',mb_name='".$username."',mb_birth='".$birth."',mb_gender='".$gender."',mb_address1='".$addr1."',mb_address2='".$addr2."',mb_zipcode='".$zipcode."',mb_telphone='".$tel."',mb_handphone='".$phone."',mb_smsYN='".$smsYN."',mb_email='".$email."',mb_emailYN='".$emailYN."',mb_grade='".$grade."',mb_update_date='".date("Y-m-d H:i:s")."' WHERE mb_id='".$user_id."'";
    $update_result   = mysqli_query($my_db, $update_query);

    if($update_result) {
      echo "수정 성공!";
      echo "<script>location.href='./member_list_admin.php';</script>";
    }else{
      echo "수정 실패";
      echo "<script>location.href='./member_list_admin.php';</script>";
    }


?>
</body>
</html>