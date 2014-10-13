<link href='http://fonts.googleapis.com/css?family=Radley:400,400italic' rel='stylesheet' type='text/css'>

<div id="welcome">
	Welcome <?php echo $_SESSION['user_name']; ?>.
</div>

<a id="logOut" href="portal.php?logout">Logout</a>

<?php
	if(isset ($_GET['id']) === true){
		include ("./php/php-login/1-minimal/views/idSet.php");
	} else{
		echo '
		<div style="max-width: 500px; margin: auto;" class="list">
				<div class="header">
					Projects
				</div>
				<div class="items">';
				
				$connect = mysqli_connect("localhost", "root", "");
				mysqli_select_db($connect, "clientcenter");
				if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
					$sql = "SELECT * FROM `projects`";
				} else{
					$sql = "SELECT * FROM `projects` WHERE `client`='" . $_SESSION['user_name'] . "'";
				}
				$query = mysqli_query($connect, $sql);
				while($row = mysqli_fetch_array($query)){
					echo '
					<div class="item" data-id="' . $row['id'] . '">' .
					$row['name']
					. '</div>
					';
				}		
		echo '
		</div>
		</div>
		<script>
		$(".item").click(function(){
			window.location = "portal.php?id=" + $(this).attr("data-id");
		});
		
		function loggedLoad(){
			
		}
		</script>';
	}
?>

