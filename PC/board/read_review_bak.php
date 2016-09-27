<?
include_once $_SERVER['DOCUMENT_ROOT']."/mnv_mall/config.php";
include_once $_mnv_PC_dir."header.php";

$idx				= $_GET['idx'];
$pg				= $_GET['pg'];
$user_id			= $_GET['mb_id'];
$goods_code	= $_GET['goods_code'];

$hit_query		= "UPDATE ".$_gl['board_review_table']." SET hit=hit+1 WHERE idx='".$idx."'";
$result			= @mysqli_query($my_db, $hit_query); 

$s_query			= "SELECT * FROM ".$_gl['board_review_table']." WHERE idx='".$idx."'";
$result			= @mysqli_query($my_db, $s_query);
$data				= @mysqli_fetch_array($result);
?>
<body>
  <table width="580" cellpadding="2" cellspacing="1">
    <tr>
      <td colspan="4" height="20" align="center" bgcolor="#777"><?=$data['subject']?></td>
    </tr>
    <tr>
      <td>아이디</td>
      <td><?=$data['user_id']?></td>
      <td>조회수</td>
      <td><?=$data['hit']?></td>
    </tr>
    <tr>
      <td colspan="4"><pre><?=$data['content']?></pre></td>
    </tr>
    <tr>
      <table width="100%">
        <td>
          <a href="list_review.php?pg=<?=$pg?>">[목록보기]</a>
          <a href="reply_review.php?idx=<?=$idx?>">[답글달기]</a>
          <a href="edit_review.php?idx=<?=$idx?>">[수정]</a>
          <a id="del_review">[삭제]</a>
        </td>
      </table>
    </tr>
  </table>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#del_review').on('click', function() {
        var tempAlert = confirm("정말로 삭제하시겠습니까?");
        if(tempAlert){
          $.ajax({
            method: 'POST',
            url: '../main_exec.php',
            data: {
              exec        : "delete_review",
              user_id     : $('#user_id').val(),
              goods_code  : $('#goods_code').val(),
              idx         : <?=$idx?>,
              group_id    : <?=$data['group_id']?>
            },
            success: function(res){
              if(res == "Y")
              {
                alert("리뷰가 삭제되었습니다.");
                location.href="list_review.php";
              }else{
                alert("리뷰 삭제 실패");
                location.reload();
              }
            }
          })
        }else{
          return;
        }
      })
    });
  </script>
</body>
</html>
