
<?php

	include_once('../connection/connection.php');
	if(ISSET($_POST['add'])){
		$question = $_POST['question'];
		$answer = $_POST['answer'];
    mysqli_query($conn, "INSERT INTO `faq` (question, answer) VALUES('$question', '$answer')");
	}
?>