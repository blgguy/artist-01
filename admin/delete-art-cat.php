<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_art_category WHERE art_cat_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	// Delete from tbl_art_category
	$statement = $pdo->prepare("DELETE FROM tbl_art_category WHERE art_cat_id=?");
	$statement->execute(array($_REQUEST['id']));

	// Unlink all art from directory
	$statement = $pdo->prepare("SELECT * FROM tbl_art WHERE art_cat_id=?");
	$statement->execute(array($_REQUEST['id']));
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
	foreach ($result as $row) {
		unlink('../assets/uploads/'.$row['art_path']);
	}

	// Delete from tbl_art
	$statement = $pdo->prepare("DELETE FROM tbl_art WHERE art_cat_id=?");
	$statement->execute(array($_REQUEST['id']));

	header('location: art-cat.php');
?>