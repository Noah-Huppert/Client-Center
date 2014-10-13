<?php
	$connect = mysqli_connect("localhost", "root", "");
	mysqli_select_db($connect, "clientcenter");
	$sql = htmlentities($_GET['q']);
	$query = mysqli_query($connect, $sql);
	echo "
	<script>
	window.history.back();
	</script>";
?>