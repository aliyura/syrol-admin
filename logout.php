<?php
session_start();
error_reporting(0);
include('include/config.php');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE adminlog  SET logout = '$ldate' WHERE userName = '".$_SESSION['alogin']."' ORDER BY id DESC LIMIT 1");
$_SESSION['alogin']=="";
session_unset();
//session_destroy();
$_SESSION['errmsg']="You have successfully logout";
?>
<script language="javascript">
document.location="index.php";
</script>
