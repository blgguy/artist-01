<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if(empty($_POST['full_name'])) {
        $valid = 0;
        $error_message .= "Name can not be empty<br>";
    }

    if(empty($_POST['email'])) {
        $valid = 0;
        $error_message .= 'Email address can not be empty<br>';
    } else {
    	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	        $valid = 0;
	        $error_message .= 'Email address must be valid<br>';
	    } else {
	    	$statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
	    	$statement->execute(array($_POST['email']));
	    	$total = $statement->rowCount();							
	    	if($total) {
	    		$valid = 0;
	        	$error_message .= 'Email address already exists<br>';
	    	}
	    }
    }

    if( empty($_POST['password']) || empty($_POST['re_password']) ) {
        $valid = 0;
        $error_message .= "Password can not be empty<br>";
    }

    if( !empty($_POST['password']) && !empty($_POST['re_password']) ) {
    	if($_POST['password'] != $_POST['re_password']) {
	    	$valid = 0;
	        $error_message .= "Passwords do not match<br>";	
    	}        
    }

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

    	if($path=='') {
    		// saving into the database
    		$statement = $pdo->prepare("INSERT INTO tbl_user (full_name,email,phone,password,photo,role,status) VALUES (?,?,?,?,?,?,?)");
    		$statement->execute(array($_POST['full_name'],$_POST['email'],$_POST['phone'],md5($_POST['password']),'',$_POST['role'],$_POST['status']));
    	} else {
    		// getting auto increment id for photo renaming
    		$statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_user'");
    		$statement->execute();
    		$result = $statement->fetchAll();
    		foreach($result as $row) {
    			$ai_id=$row[10];
    		}

    		// uploading the photo into the main location and giving it a final name
    		$final_name = 'user-'.$ai_id.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // saving into the database
    		$statement = $pdo->prepare("INSERT INTO tbl_user (full_name,email,phone,password,photo,role,status) VALUES (?,?,?,?,?,?,?)");
    		$statement->execute(array($_POST['full_name'],$_POST['email'],$_POST['phone'],md5($_POST['password']),$final_name,$_POST['role'],$_POST['status']));
    	}

    	unset($_POST['full_name']);
    	unset($_POST['email']);
    	unset($_POST['phone']);

    	$success_message = 'User is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add User</h1>
	</div>
	<div class="content-header-right">
		<a href="user.php" class="btn btn-primary btn-sm">View All</a>
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
							<label for="" class="col-sm-2 control-label">Name <span>*</span></label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="full_name" value="<?php if(isset($_POST['full_name'])) {echo $_POST['full_name'];} ?>">
							</div>
						</div>
						
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Email Address <span>*</span></label>
							<div class="col-sm-4">
								<input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Phone </label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="phone" value="<?php if(isset($_POST['phone'])) {echo $_POST['phone'];} ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Password <span>*</span></label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Retype Password <span>*</span></label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="re_password">
							</div>
						</div>
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Photo</label>
				            <div class="col-sm-6" style="padding-top:6px;">
				                <input type="file" name="photo">
				            </div>
				        </div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Select Role <span>*</span></label>
							<div class="col-sm-4">
								<select name="role" class="form-control">
									<option value="Admin">Admin</option>
								</select>
							</div>
						</div>
				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Active? </label>
				            <div class="col-sm-6">
				                <label class="radio-inline">
				                    <input type="radio" name="status" value="Active" checked>Yes
				                </label>
				                <label class="radio-inline">
				                    <input type="radio" name="status" value="Inactive">No
				                </label>
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