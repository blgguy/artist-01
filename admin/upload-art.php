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

    if(empty($_POST['art_price'])) {
        $valid = 0;
        $error_message .= "Art price can not be empty<br>";
    }

    if(empty($_POST['art_currency'])) {
        $valid = 0;
        $error_message .= "Currency can not be empty<br>";
    }

    if(empty($_POST['art_cat_id'])) {
        $valid = 0;
        $error_message .= "You have to select the art category<br>";
    }
    
    if($valid == 1) {
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

         // saving into the database
		$statement = $pdo->prepare("INSERT INTO tbl_art (art_name,art_description,art_price,currency,art_path,art_cat_id) VALUES (?,?,?,?,?,?)");
		$statement->execute(array($_POST['art_name'],$_POST['art_description'],$_POST['art_price'],$_POST['art_currency'],$final_name,$_POST['art_cat_id']));


            	$success_message = 'art uploaded successfully.';
                
    	}
		}
		else
		$error_message="File size Max 1MB or Invalid file format supports .jpg and .bmp";
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Upload art</h1>
	</div>
	<div class="content-header-right">
		<a href="art.php" class="btn btn-primary btn-sm">View All Art</a>
	</div>
</section>


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
							<label for="" class="col-sm-2 control-label">Art Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="art_name">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art discription <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="art_description">
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
								<input type="number" class="form-control" name="art_price">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Upload Art <span>*</span></label>
							<div class="col-sm-4" style="padding-top:6px;">
								<input type="file" name="art">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Art Category <span>*</span></label>
							<div class="col-sm-4">
								<select class="form-control" name="art_cat_id">
									<option value="">Select the art category</option>
									<?php
									$statement = $pdo->prepare("SELECT * FROM tbl_art_category ORDER BY art_cat_name ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
									foreach ($result as $row) {
										echo '<option value="'.$row['art_cat_id'].'">'.$row['art_cat_name'].'</option>';
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