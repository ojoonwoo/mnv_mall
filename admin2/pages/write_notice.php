<?
include_once "header.php";
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<style>
	a {
		text-decoration: none;
		color: #000;
	}
	a:hover {
		text-decoration: none;
		color: #000;
	}
</style>
<body>
	<div id="wrapper">
		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">쇼핑몰 관리자</a>
			</div>
			<!-- /.navbar-header -->

			<?
			include_once "top_navi.php";
			include_once "side_navi.php";
			?>
			</div>
		<!-- /.navbar-static-side -->
		</nav>
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">공지사항 작성</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<form method="post" id="modify_form" role="form">
								<div class="col-lg-12">
									<div class="form-group">
										<label class="col-sm-2">아이디</label>
										<input class="form-control" type="text" id="user_id" name="user_id" value="촌의감각">
									</div>
									<div class="form-group">
										<label class="col-sm-2">제목</label>
										<input class="form-control" type="text" id="subject" name="subject">
									</div>
									<div class="form-group">
										<label class="col-sm-2">노출여부</label>
										<input class="form-control" type="text" id="showYN" name="showYN" value="Y">
									</div>
									<div class="form-group">
										<label class="col-sm-2">내용</label>
										<textarea name="content"  id="content" rows="10" cols="100" style="width:100%; height:412px; display:none;"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group" style="text-align:center;">
											<input class="form-control" type="button" id="write_notice" value="확인">
											<input class="form-control" type="button" onclick="history.back();" value="취소">
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- /.row (nested) -->
					</div>
					<!-- /.panel-body -->
				</div>
				<!-- /.panel -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /#page-wrapper -->
	</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

<!-- Naver SmartEditor -->
<script type="text/javascript" src="../../lib/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

<script>
	var oEditors    = [];
	var m_oEditors  = [];

	nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "content",
		sSkinURI: "../../lib/smarteditor/SmartEditor2Skin.html",  
		htParams : {
			bUseToolbar : true,       // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseVerticalResizer : true,   // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
			bUseModeChanger : true,     // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
			//aAdditionalFontList : aAdditionalFontSet,   // 추가 글꼴 목록
			fOnBeforeUnload : function(){
				//alert("완료!");
			}
		}, //boolean
		fOnAppLoad : function(){
			//예제 코드
			//oEditors.getById["ir1"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
		},
		fCreator: "createSEditor2"
	});

	$('#write_notice').on('click', function(){

		var user_id = $('#user_id').val();
		var subject = $('#subject').val();
		var content = oEditors.getById['content'].getIR();
		var showYN  = $("#showYN").val();

		if(user_id == ''){
			alert("아이디를 입력해주세요.")
			return;
		}
		if(subject == ''){
			alert("제목을 입력해주세요.")
			return;
		}
		if(content == ''){
			alert("내용을 입력해주세요.")
			return;
		}

		$.ajax({
			method: 'POST',
			url: './admin_exec.php',
			data: {
				exec        : "write_notice",
				user_id     : user_id,
				subject     : subject,
				content     : content,
				showYN      : showYN
			},
				success: function(res){
					if(res=="Y")
					{
						alert("작성되었습니다.");
						location.href="list_notice.php";
					}else{
						alert("작성실패");
						location.reload();
					}
				}
			})
		});
</script>
</body>
</html>
