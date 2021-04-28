<?php

session_start();
include('include/config.php');

if(!empty($_FILES))
{
	if(is_uploaded_file($_FILES['docFile']['tmp_name']))
	{
		sleep(1);
		$docFile=time() . '_' .$_FILES['docFile']['name'];
		$source_path = $_FILES['docFile']['tmp_name'];
		$target_path = 'lecturesvideos/' . $docFile;
		if(move_uploaded_file($source_path, $target_path))
		{
			//echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" />';
			$categoryIdName=explode("_",$_POST['course']);
			$course_id   = $categoryIdName[0];
			$course_code = $categoryIdName[1];
			$course_name = $categoryIdName[2];
			$vid_title = $_POST['vid_title'];

			$sql=mysqli_query($con,"insert into videos(course_id,course_name,course_code,vid_name,vid_title) values('$course_id','$course_name','$course_code','$docFile','$vid_title')");
			$_SESSION['msg']="New Video Created !!";
			
		}
	}
}

?>