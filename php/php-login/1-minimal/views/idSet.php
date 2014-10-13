<?php
if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
	echo "<button id='newProject'>New Project <span class='glyphicon glyphicon-plus'></span></button><div id='register'>";
	include ("./php/php-login/1-minimal/register.php");
	echo "</div>";
}
$connect = mysqli_connect("localhost", "root", "");
mysqli_select_db($connect, "clientcenter");
$hoursTotal = 0;
$projectInfo = array();
$hoursCounter = 0;
$changelogCounter = 0;
$todoCounter = 0;

$projectInfo['client'] = 'No Data';
$projectInfo['name'] = 'No Data';
$projectInfo['previewAddress'] = '';
$projectInfo['hours'][0]['hours'] = '"No Data"';
$projectInfo['hours'][0]['date'] = '"No Data"';
$projectInfo['changeLog'][0] = 'No Data';
$projectInfo['todo'][0]['message'] = 'No Data';
$projectInfo['todo'][0]['bug'] = 'false';

//Project ID
if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
	$sql = "SELECT * FROM `projects` WHERE `id`='" . $_GET['id'] . "'";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$projectInfo['id'] = $row['id'];
	}
} else{
	$sql = "SELECT * FROM `projects` WHERE `client`='" . $_SESSION['user_name'] . "' AND `id`='" . $_GET['id'] . "'";
	$query = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($query)){
		$projectInfo['id'] = $row['id'];
	}	
}

//Project Client AND Name
$sql = "SELECT * FROM `projects` WHERE `id`='" . $projectInfo['id'] . "'";
$query = mysqli_query($connect, $sql);
if(is_bool($query) === false && count($query) > 0){
	while($row = mysqli_fetch_array($query)){
		$projectInfo['client'] = $row['client'];
		$projectInfo['name'] = $row['name'];
	}
}

//Preview Address
$sql = "SELECT * FROM `previewaddress` WHERE `projectID`='" . $projectInfo['id'] . "'";
$query = mysqli_query($connect, $sql);
if(is_bool($query) === false && count($query) > 0){
	while($row = mysqli_fetch_array($query)){
		$projectInfo['previewAddress'] = $row['address'];
	}
}


//Hours
$sql = "SELECT * FROM `hours` WHERE `projectID`='" . $projectInfo['id'] . "' ORDER BY  `hours`.`date` DESC ";
$query = mysqli_query($connect, $sql);
if(is_bool($query) === false && count($query) > 0){
	while($row = mysqli_fetch_array($query)){
		$projectInfo['hours'][$hoursCounter]['hours'] = $row['hours'];
		$projectInfo['hours'][$hoursCounter]['date'] = $row['date'];
		$hoursCounter = $hoursCounter + 1;
	}
}

//Change Log
$sql = "SELECT * FROM `changelog` WHERE `projectID`='" . $projectInfo['id'] . "' ORDER BY  `id` DESC ";
$query = mysqli_query($connect, $sql);
if(is_bool($query) === false && count($query) > 0){
	while($row = mysqli_fetch_array($query)){
		$projectInfo['changeLog'][$changelogCounter] = $row['message'];
		$changelogCounter = $changelogCounter + 1;
	}
}

//To Do
$sql = "SELECT * FROM `todo` WHERE `projectID`='" . $projectInfo['id'] . "' ORDER BY  `id` DESC ";
$query = mysqli_query($connect, $sql);
if(is_bool($query) === false && count($query) > 0){
	while($row = mysqli_fetch_array($query)){
		$projectInfo['todo'][$todoCounter]['message'] = $row['message'];
		$projectInfo['todo'][$todoCounter]['bug'] = $row['bug'];
		$todoCounter = $todoCounter + 1;
	}
}
?>

<div id="content" class="row">
	<div class="col-md-3">
		<div id="clientInteraction">
			<button id="livePreview">
				Live Preview&nbsp;<span class="glyphicon glyphicon-eye-open"></span>
			</button>
			<?php
				if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
					echo "
					<input id='changePrev' type='text' val='" . $projectInfo['previewAddress'] . "' />
					<button id='changePrevButton' ><span class='glyphicon glyphicon-eye-open'></span></button>
					<script>
						$('#changePrevButton').click(function(){
							window.location = " . '"' . "query.php?q=UPDATE `previewaddress` SET `address`='" . '"' . "+ $('#changePrev').val() +" . '"' . "' WHERE 1" . '"' . ";
						});
					</script>
					";	
				}
			?>
			<div id="time">
				<?php
					foreach($projectInfo['hours'] as $value){
						$hoursTotal = $hoursTotal + (float)$value['hours'];
					}
				
					/*if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
						echo "<button id='newHourButton'><span class='glyphicon glyphicon-time'></span></button>
						<input style='width: 25px; margin: 0; padding: 0; font-size: 18px;' value='No' type='text' id='newHour'/> Hours";
						echo "
						<script>
							$('#newHour').val(" . $hoursTotal . ");
							$('#newHourButton').click(function(){
								window.location =" . "'" . "query.php?q= UPDATE `hours` SET `hours`='" . '+ $("#newHour").val() +' . "' WHERE `projectID`=" . $projectInfo['id'] . "';
							});
						</script>
						";
					} else{*/
						echo "<span id='icon' class='glyphicon glyphicon-time'></span><span id='hours'>No</span> Hours";
						echo "
						<script>
							$('#hours').html(" . $hoursTotal . ");
						</script>
						";
					//}
					echo "
					<script>
					$('#livePreview').click(function(){
						window.location = " . '"' . $projectInfo['previewAddress'] . '"' . ";
					});
					</script>";
					
					echo '
					<div class="panel panel-default" style="max-width: 280px; margin: auto;">';
					
					if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
						$hoursDeleteHeader = '<th></th>';
						$hoursDeleteScript = "
						<script>
							$('.hoursMinus').click(function(){
								window.location = " . '"' . "query.php?q=DELETE FROM `hours` WHERE `date`='" . '"' . "+ $(this).attr('data-delete') + " . '"' . "'" . '"' . ";
							});
						</script>
						";
						echo "
						<div  class='input-group'>
							<input type='date' id='newDate' class='form-control' />
							<input type='number' id='newHours' class='form-control' />
							<button id='addHours' class='glyphicon glyphicon-plus headerButton'></button>
						</div>
						<script>
							$('#addHours').click(function(){
								window.location = " . '"' . "query.php?q=INSERT INTO `clientcenter`.`hours` (`projectID`, `date`, `hours`) VALUES ('" . $projectInfo['id'] . "', '" . '"' . "+ $('#newDate').val()+" . '"' . "', '" . '"' . "+ $('#newHours').val().toString() +" . '"' . "') " . '"' . ";
							});
						</script>";	
					} else{
						$hoursDeleteHeader = '';
						$hoursDeleteButton = '';
						$hoursDeleteScript = '';
					}
					echo '
					<table class="table">
					<thead>
						<tr>
							<th>Date</td>
							<th>Hours</td>' . $hoursDeleteHeader . '
						</tr>
					</thead>
					<tbody>
					';
					
					foreach($projectInfo['hours'] as $value){
						if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
							$hoursDeleteButton = "<td><button data-delete='" . $value['date'] . "' class='glyphicon glyphicon-minus listButton hoursMinus'></button></td>";	
						}	
						echo '<tr><td>' . $value['date'] . '</td><td>' . $value['hours'] . '</td>' . $hoursDeleteButton . '</tr>';
					}
					
					echo '</tbody></table></div>' . $hoursDeleteScript;
				?>
			</div>
			<div id="contactMe">
				If you would like to provide feedback please email me at noahhuppert@gmail.com
			</div>
		</div>
	</div>
	<div id="changeLog" class="col-md-4">
		<?php
			if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
				echo "
				<input placeholder='New Change' type='text' id='newChange' /> <button id='addChange' class='glyphicon glyphicon-plus headerButton'></button>
				<script>
					$('#addChange').click(function(){
						window.location = " . '"' . "query.php?q=INSERT INTO `clientcenter`.`changelog` (`message`, `projectID`) VALUES ('" . '"+ $("#newChange").val() + "' . "', '" . $projectInfo['id'] . "') " . '"' . ";
					});
				</script>";	
			}	
		?>
		<div class="list">
			<div class="header">
				Change Log
			</div>
			<div class="items">
			<?php
				foreach($projectInfo['changeLog'] as $value){
					if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
						$deleteCode = "
						<button data-delete='" . $value . "' class='glyphicon glyphicon-minus listButton changeMinus'></button>";
						$deleteScript = "<script>
							$('.changeMinus').click(function(){
								window.location = " . '"' . "query.php?q=DELETE FROM `changelog` WHERE `message`='" . '"' . "+ $(this).attr('data-delete') + " . '"' . "'" . '"' . ";
							});
						</script>
						";
					} else{
						$deleteCode = "";
						$deleteScript = "";
					}
					
					echo "
					<div class='item'>
					" . $value . $deleteCode .
					"</div>";
				}
				echo $deleteScript;
			?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<?php
			if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
				echo "
				<input placeholder='New To Do' type='text' id='newTodo' /> 
				<button id='addToDo' class='glyphicon glyphicon-plus headerButton'></button>
				<button id='addBug' class='glyphicon glyphicon-warning-sign headerButton'></button>
				<script>
					$('#addToDo').click(function(){
						window.location = " . '"' . "query.php?q=INSERT INTO `clientcenter`.`todo` (`bug`, `message`, `projectID`) VALUES ('false', '" . '"+ $("#newTodo").val() + "' . "', '" . $projectInfo['id'] . "') " . '"' . ";
					});
					$('#addBug').click(function(){
						window.location = " . '"' . "query.php?q=INSERT INTO `clientcenter`.`todo` (`bug`, `message`, `projectID`) VALUES ('true', '" . '"+ $("#newTodo").val() + "' . "', '" . $projectInfo['id'] . "') " . '"' . ";
					});
				</script>";	
			}	
		?>
		<div class="list">
			<div class="header">
				To Do
			</div>
			<div class="items">
			<?php				
				foreach($projectInfo['todo'] as $value){
					if(strcmp($_SESSION['user_name'], 'NoahHuppert') == 0){
						$deleteCode = "
						<button data-delete='" . $value['message'] . "' class='glyphicon glyphicon-minus listButton todoMinus'></button>
						";
						$deleteScript = "<script>
							$('.todoMinus').click(function(){
								window.location = " . '"' . "query.php?q=DELETE FROM `todo` WHERE `message`='" . '"' . "+ $(this).attr('data-delete') + " . '"' . "'" . '"' . ";
							});
						</script>
						";
					} else{
						$deleteCode = "";
						$deleteScript = "";
					}
					
					if(strcmp($value['bug'], 'true') == 0){
						$bugPre = '<span class="inlineBugContainer"><span class="glyphicon glyphicon-warning-sign inlineBugWarning"></span> ';
						$bugPost = '</span>';
					} else{
						$bugPre = '';
						$bugPost = '';
					}
					
					echo "
					<div class='item'>
					" . $bugPre . $value['message'] . $bugPost . $deleteCode .
					"</div>";
				}
				echo $deleteScript;
			?>
			</div>
		</div>
	</div>
</div>

<script>
	function loggedLoad() {
		$('#livePreview').css({
			'margin-left' : ($('#clientInteraction').width() - 155) / 2
		});
		$('.list').css({
			'margin-left' : ($('#changeLog').width() - $('.list').width()) / 2
		});
		$('#changePrev').css({
			'margin-left' : ($('#clientInteraction').width() - $('#changePrev').width()) / 2
		});
	}
	
	$('#newProject').click(function(){
		$('#register').toggle('slide');
	});
</script>