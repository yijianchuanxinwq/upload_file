<?php
//	上传文件
	header('Content-Type: text/html; charset=utf-8');
//	print_r($_FILES['upfile']);
	header("Access-Control-Allow-Origin:*");	
 	ini_set("error_reporting","E_ALL & ~E_NOTICE");
	$filename=$_FILES['upfile']['name'];//上传文件名
	$type=$_FILES['upfile']['type'];//上传文件类型
	$tmp_name=$_FILES['upfile']['tmp_name'];//上传文件临时路径
	$size=$_FILES['upfile']['size'];//上传文件大小
	$error=$_FILES['upfile']['error'];//错误码
	$maxsize=2097152;//文件大小，2M
	if($error==0){
		$path='./upload';//指定文件上传的文件夹
		if(!file_exists($path)){//如果文件夹不存在创建
			mkdir($path,0777,true);
			chmod($path,0777);
		}
		$uniName=md5(uniqid(microtime(true),true)).'.'.$ext.'xml';//确保文件名唯一，防止重名产生覆盖
		$destination=$path.'/'.$uniName;//指定文件夹下
		if(move_uploaded_file($tmp_name,$destination)){
			move_uploaded_file($tmp_name,$destination);//将临时文件移到指定文件夹下
			echo $destination;
		}else{
			echo "文件上传失败";
		}
		
//		if($size>$maxsize){
//			echo "上传文件过大";
//		}
//		
//		if(!is_uploaded_file($tmp_name)){//判断文件是否通过HTTP POST方式传递上来
//			echo "文件不是通过HTTP POST方式传递上来的";
//		}
		
	}else if($error==1){
		echo "文件大小超过限制项";
	}else if($error==2){
		echo "文件大小超过表单";
	}else if($error==3){
		echo "文件部分被上传";
	}else if($error==4){
		echo "没有文件被上传";
	}else if($error==6){
		echo "找不到临时文件夹";
	}else if($error==7){
		echo "文件写入失败";
	}else if($error==8){
		echo "上传文件被php程序中断";
	}
?>