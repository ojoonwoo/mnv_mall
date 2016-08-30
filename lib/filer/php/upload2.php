<?php
	include_once "../../../config.php";
    include('class.uploader.php');
    
    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => '../../../admin/uploads2/'.$_REQUEST['b_idx'].'/', //Upload directory {String}
        'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        //'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onComplete' => 'onFilesCompleteCallback', //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));

	if($data['isComplete']){
        $files = $data['data'];
		$file_txt	= "";
		$i			= 0;
		foreach($files['files'] as $key => $val)
		{
			//$file_txt	.= "||".$val;
			$file_txt	= $val;
			$i++;
		}

		if ($_REQUEST['ig'] == "goods" )
		{
			// 상품정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['goods_info_table']." SET goods_img_url='".$file_txt."' WHERE goods_code='".$_REQUEST['goodscode']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}else if ($_REQUEST['ig'] == "banner" ){
			// 배너정보에 이미지 정보 업데이트
			$goods_query		= "UPDATE ".$_gl['banner_info_table']." SET banner_img_url='".$file_txt."' WHERE idx='".$_REQUEST['b_idx']."'";
			$goods_result		= mysqli_query($my_db, $goods_query);
		}
	}

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    
    function onFilesRemoveCallback($removed_files){
        foreach($removed_files as $key=>$value){
            $file = '../uploads/' . $value;
            if(file_exists($file)){
                unlink($file);
            }
        }
        
        return $removed_files;
    }

	function onFilesCompleteCallback($file)
	{
		print_r($files);
	}
?>
