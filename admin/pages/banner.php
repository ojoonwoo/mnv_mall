<?
	include_once "header.php";
?>
<link href="../../lib/filer/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="../../lib/filer/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
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

  <!-- Page Content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">배너 관리</h1>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      <!-- /.panel-heading -->
      <button type="button" class="btn btn-outline btn-primary btn-lg" id="add_banner_btn">배너 추가</button>
      <button type="button" class="btn btn-outline btn-success btn-lg" id="list_banner_btn">배너 목록</button>
      <div class="panel-body">
        <div class="panel-body">
          <div class="table-responsive" id="add_category">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>타이틀</th>
                  <th>내용</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>배너명</td>
                  <td colspan="2">
                    <input type="text" id="banner_name" style="width:100%">
                  </td>
                </tr>
                <tr>
                  <td>배너 종류</td>
                  <td>
                    <select id="banner_type">
                      <option value="">선택하세요</option>
                      <option value="main_rolling_banner">메인 롤링 배너</option>
                      <option value="main_image_banner">메인 이미지 배너</option>
                    </select>
                  </td>
                </tr>
                <tr class="banner_detail" id="main_rolling_banner_td" style="display:none;">
                  <td>메인 롤링 배너</td>
                  <td>
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width:30%">이미지 첨부</th>
                          <th>연결 링크</th>
                        </tr>
                      </thead>
                      <tbody>
                        <form action="../../lib/filer/php/upload.php" id="img_frm" method="post" enctype="multipart/form-data">
                        <tr id="banner_detail_tr1">
                          <td>
                            <input type="file" name="files[]" id="filer_input1" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value1" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr2" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value2" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr3" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input3" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value3" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr4" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input4" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value4" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr5" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input5" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value5" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr6" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input6" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value6" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr7" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input7" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value7" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr8" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input8" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value8" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr9" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input9" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value9" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        <tr id="banner_detail_tr10" style="display:none;">
                          <td>
                            <input type="file" name="files[]" id="filer_input10" multiple="multiple">
                          </td>
                          <td>
                            <input class="form-control" id="banner_value10" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                            <button type="button" class="btn btn-primary btn-xs rolling_banner_add_btn">+</button>
                          </td>
                        </tr>
                        </form>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr class="banner_detail" id="main_image_banner_td" style="display:none;">
                  <td>메인 이미지 배너</td>
                  <td>
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="width:30%">이미지 첨부</th>
                          <th>연결링크</th>
                        </tr>
                      </thead>
                      <tbody id="banner_detail_tr">
                        <tr>
                          <td>
                            <form action="../../lib/filer/php/upload.php" id="main_image_frm" method="post" enctype="multipart/form-data">
                              <input type="file" name="files[]" id="filer_input11" multiple="multiple">
                            </form>
                          </td>
                          <td>
                            <input class="form-control" id="banner_value11" placeholder="예시) http://store-chon.com/event/event_list1.php" style="width:90%"> 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <button type="button" class="btn btn-danger btn-lg btn-block" id="submit_btn7">완 료</button>
          </div>
          <!-- /.table-responsive -->
          <div class="table-responsive" id="list_banner" style="display:none;">
            <table width="100%" class="table table-striped table-bordered table-hover" id="banner_list">
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
      </div>
      <!-- /.panel-body -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

<?
	include_once "lib.php";
?>
	<!-- DataTables JavaScript -->
	<script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	<script src="../bower_components/datatables-responsive/js/dataTables.responsive.js"></script>

	<script src="../../lib/filer/js/jquery.filer.min.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
	var banner_num	= 1;
	$(document).ready(function() {
		// 배너 리스트
		// 작업해야함
		//show_banner_list("banner_list");

		// 테이블 api 세팅 
		/*
		var table	= $('#banner_list').DataTable({
			"columnDefs": [ {
				"searchable": false,
				"orderable": false,
				"targets": 0
			} ],
			"order": [[ 1, 'asc' ]],
			"ordering":false,
			"searching": true
		});
		*/
	});

	for (var filer_cnt = 1; filer_cnt <= 11; filer_cnt++)
	{
		$('#filer_input'+filer_cnt).filer({
			showThumbs: true,
			templates: {
				box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
				item: '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-info">\
											<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
											<span class="jFiler-item-others">{{fi-size2}}</span>\
										</div>\
										{{fi-image}}\
									</div>\
									<div class="jFiler-item-assets jFiler-row">\
										<ul class="list-inline pull-left"></ul>\
										<ul class="list-inline pull-right">\
											<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
										</ul>\
									</div>\
								</div>\
							</div>\
						</li>',
				itemAppend: '<li class="jFiler-item">\
								<div class="jFiler-item-container">\
									<div class="jFiler-item-inner">\
										<div class="jFiler-item-thumb">\
											<div class="jFiler-item-status"></div>\
											<div class="jFiler-item-info">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
											{{fi-image}}\
										</div>\
										<div class="jFiler-item-assets jFiler-row">\
											<ul class="list-inline pull-left">\
												<li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
											</ul>\
											<ul class="list-inline pull-right">\
												<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
											</ul>\
										</div>\
									</div>\
								</div>\
							</li>',
				itemAppendToEnd: false,
				removeConfirmation: true,
				_selectors: {
					list: '.jFiler-items-list',
					item: '.jFiler-item',
					remove: '.jFiler-item-trash-action'
				}
			},
			addMore: false
		});
	}

	</script>
</body>
</html>
