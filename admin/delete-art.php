<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_art WHERE art_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
	
// Getting art ID to unlink from folder
$statement = $pdo->prepare("SELECT * FROM tbl_art WHERE art_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$art_name = $row['art_name'];
}

// Unlink all art from the directory
if($art_name!='') {
	unlink('../assets/uploads/'.$art_name);
}

// Delete from tbl_art
$statement = $pdo->prepare("DELETE FROM tbl_art WHERE art_id=?");
$statement->execute(array($_REQUEST['id']));

header('location: art.php');
?>