<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
	$path = "../assets/uploads/";
    $valid_formats = array("jpg", "bmp", "jpeg");
	$name = $_FILES['art']['name'];

	if(empty($_POST['art_name'])) {
        $valid = 0;
        $error_message .= "Art Name can not be empty<br>";
    }

    if(empty($_POST['art_description'])) {
        $valid = 0;
        $error_message .= "Art description can not be empty<br>";
    }

    if(empty($_POST['art_currency'])) {
        $valid = 0;
        $error_message .= "Currency sign can not be empty<br>";
    }

    if(empty($_POST['art_price'])) {
        $valid = 0;
        $error_message .= "Art price can not be empty<br>";
    }

    if($valid == 1) {

    	if($name == '') {
    		// updating into the database
			$statement = $pdo->prepare("UPDATE tbl_art SET art_name=?, art_description=?, art_price=?, currency=?, art_cat_id=? WHERE art_id=?");
			$statement->execute(array($_POST['art_name'],$_POST['art_description'],$_POST['art_price'],$_POST['art_currency'],$_POST['art_cat_id'],$_REQUEST['id']));
    	} else {
    		unlink('../assets/uploads/'.$_POST['previous_art']);

    		// $final_name = 'art-'.$_REQUEST['id'].'.'.$ext;
        	// move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

    		$ai_id=time();		
			$filename = $_POST['art_name'];

   			list($txt, $ext) = explode(".", $name);
   			if(in_array($ext,$valid_formats)&& $_FILES['art']['size'] <= 1024*1024){

    		$upload_status = move_uploaded_file($_FILES['art']['tmp_name'], $path.$_FILES['art']['name']);
    		if($upload_status){
    			$final_name = 'art-'.$ai_id.'-'.$filename.".jpg";
        		$new_name = $path.'art-'.$ai_id.'-'.$filename.".jpg";
        		if(watermark_image($path.$name, $new_name))
                	$demo_image = $new_name;

        	// updating into the database
			$statement = $pdo->prepare("UPDATE tbl_art SET art_name=?, art_description=?, art_price=?, currency=?, art_path=?, art_cat_id=? WHERE art_id=?");
			$statement->execute(array($_POST['art_name'],$_POST['art_description'],$_POST['art_price'],$_POST['art_currency'],$final_name,$_POST['art_cat_id'],$_REQUEST['id']));
    	}

		}
		else
		$error_message="File size Max 1MB or Invalid file format supports .jpg and .bmp";
    }
    $success_message = 'Art updated successfully.';
}
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_art WHERE art_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit art</h1>
	</div>
	<div class="content-header-right">
		<a href="art.php" class="btn btn-primary btn-sm">View All Art</a>
	</div>
</section>

<?php							
foreach ($result as $row) {
	$art_name = $row['art_name'];
	$art_description = $row['art_description'];
	$art_price = $row['art_price'];
	$art_path = $row['art_path'];
	$art_cat_id = $row['art_cat_id'];
}
?>

<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php if($error_message): ?>
			<div class="callout callout-danger">
			<h4>Please correct the following errors:</h4>
			<p>
			<?php echo $error_message; ?>
			</p>
			</div>
			<?php endif; ?>

			<?php if($success_message): ?>
			<div class="callout callout-success">
			<h4>Success:</h4>
			<p><?php echo $success_message; ?></p>
			</div>
			<?php endif; ?>

			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art Title <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="art_name" value="<?php echo $art_name ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art Discription <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="art_description" value="<?php echo $art_description ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Currency <span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="art_currency">
									<option value="Naira">select currncy</option>	
									<option value="Naira">Naira</option>	
									<option value="USD">USD</option>	
									<option value="EURO">EURO</option>	
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art Price <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="art_price" value="<?php echo $art_price; ?>">
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Existing art</label>
				            <div class="col-sm-6" style="padding-top:6px;">
				                <img src="../assets/uploads/<?php echo $art_path; ?>" class="existing-art" style="width:300px;">

				                <input type="hidden" name="previous_art" value="<?php echo $art_path; ?>">
				            </div>
				        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Upload New art <span>*</span></label>
							<div class="col-sm-4" style="padding-top:6px;">
								<input type="file" name="art">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art Category <span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="art_cat_id">
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_art_category ORDER BY art_cat_name ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
									foreach ($result as $row) {
										if($row['art_cat_id'] == $art_cat_id) {
											$selected = 'selected';
										} else {
											$selected = '';
										}
										echo '<option value="'.$row['art_cat_id'].'" '.$selected.'>'.$row['art_cat_name'].'</option>';
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

<?php require_once('footer.php'); ?>