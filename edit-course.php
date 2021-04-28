<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
	$cid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$courseName=$_POST['courseName'];
	$courseCode=$_POST['courseCode'];
	$courseType=$_POST['courseType'];
	$courseTools=$_POST['courseTools'];
	$courseShortDescription=$_POST['courseShortDescription'];
	$courseSummary=addslashes($_POST['courseSummary']);
	$courseDetail=addslashes($_POST['courseDetail']);
	$courseStartDate=date('Y-m-d',strtotime($_POST['courseStartDate']));
	$courseInstructorName=$_POST['courseInstructorName'];
	$coursePrice=$_POST['coursePrice'];
	$courseRating=$_POST['courseRating'];
	$courseSyllabusLink=$_POST['courseSyllabusLink'];
	$courseIsActive=$_POST['courseIsActive'];
	$sql=mysqli_query($con,"update  courses set courseName='$courseName',courseCode='$courseCode',courseType='$courseType',courseTools='$courseTools',courseShortDescription='$courseShortDescription',courseSummary='$courseSummary',courseDetail='$courseDetail',courseStartDate='$courseStartDate',courseInstructorName='$courseInstructorName',coursePrice='$coursePrice',courseRating='$courseRating',courseSyllabusLink='$courseSyllabusLink',courseIsActive='&courseIsActive'   where id='$cid'");
	$_SESSION['msg']="Course Updated Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Edit Course</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script src="nicEdit.js" type="text/javascript"></script>
	<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

   <script>
function getSubcat(val) {
	$.ajax({
	type: "POST",
	url: "get_subcat.php",
	data:'cat_id='+val,
	success: function(data){
		$("#subcategory").html(data);
	}
	});
}
function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>	


</head>
<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
<?php include('include/sidebar.php');?>				
			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Insert Product</h3>
							</div>
							<div class="module-body">

									<?php if(isset($_POST['submit']))
{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">

<?php 

$query=mysqli_query($con,"select * from courses where id='$cid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{ 
?>

<div class="control-group">
<label class="control-label" for="basicinput">Course Name</label>
<div class="controls">
<input type="text" value= "<?php echo $row['courseName']; ?>" name="courseName"  placeholder="Enter Course Name" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Code</label>
<div class="controls">
<input type="text"  value="<?php echo $row['courseCode']; ?>"  name="courseCode"  placeholder="Enter Course Code" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Type</label>
<div class="controls">
<input type="text"  value="<?php echo $row['courseType']; ?>"  name="courseType"  placeholder="Enter Course Type" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Tools</label>
<div class="controls">
<input type="text"  value="<?php echo $row['courseTools']; ?>"   name="courseTools"  placeholder="Enter Course Tools" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Short Description</label>
<div class="controls">
<input type="text" value= "<?php echo $row['courseShortDescription']; ?>" name="courseShortDescription"  placeholder="Enter Course Short Description" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Summary</label>
<div class="controls">
<textarea style="height:250px;" name="courseSummary"  placeholder="Enter Course Summary" rows="6" class="span8 tip"><?php echo stripslashes($row['courseSummary']);?></textarea> </div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Details</label>
<div class="controls">
<textarea style="height:350px;"  name="courseDetail"  placeholder="Enter Course Detail" rows="6" class="span8 tip"><?php echo stripslashes($row['courseDetail']);?></textarea> </div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Start Date</label>
<div class="controls">
<input value= "<?php echo date('d-m-Y',strtotime($row['courseStartDate'])); ?>" type="text" id="datepicker" placeholder="Enter Start Date"  name="courseStartDate" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Instructor Name</label>
<div class="controls">
<input type="text"  value= "<?php echo $row['courseInstructorName']; ?>"   name="courseInstructorName"  placeholder="Enter Instructor name" class="span8 tip">  
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Course Price</label>
<div class="controls">
<input type="text"  value= "<?php echo $row['coursePrice']; ?>"   name="coursePrice"  placeholder="Enter Course Price" class="span8 tip" required>
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Rating</label>
<div class="controls">
<input type="text"  value= "<?php echo $row['courseRating']; ?>"   name="courseRating"  placeholder="Enter Course Rating" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Syllabus Link</label>
<div class="controls">
<input type="text"  value= "<?php echo $row['courseSyllabusLink']; ?>"   name="courseSyllabusLink"  placeholder="Enter Course Syllabus Link" class="span8 tip">
</div>
</div>

<div class="control-group">
<label class="control-label" for="basicinput">Course Active</label>
<div class="controls">
<select   name="courseIsActive"  id="courseIsActive" class="span8 tip" required>
<option value="Active" selected>Active</option>
<option value="Inactive">InActive</option>
</select>
</div>
</div>



<div class="control-group">
<label class="control-label" for="basicinput">Course Image</label>
<div class="controls">
<img src="courseimages/<?php echo htmlentities($cid);?>/<?php echo htmlentities($row['courseImage']);?>" width="200" height="100"> <a href="update-image1.php?id=<?php echo $row['id'];?>">Change Image</a>
</div>
</div>


<div class="control-group">
<label class="control-label" for="basicinput">Instructor Image</label>
<div class="controls">
<img src="courseimages/<?php echo htmlentities($cid);?>/<?php echo htmlentities($row['courseInstructorImage']);?>" width="50" height="50"> <a href="update-image2.php?id=<?php echo $row['id'];?>">Change Image</a>
</div>
</div>


<?php } ?>
	<div class="control-group">
											<div class="controls">
												<button type="submit" name="submit" class="btn">Update Course</button>
											</div>
										</div>
									</form>
							</div>
						</div>


	
						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
	<script>
	  $( function() {
		$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy', minDate: 0 }).val();
	  });
  </script>
</body>
<?php } ?>