<?php require_once('header.php'); ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Arts</h1>
	</div>
	<div class="content-header-right">
		<a href="upload-art.php" class="btn btn-primary btn-sm">Upload New Art</a>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
			        <th>SL</th>
                    <th>Art</th>
                    <th>Title</th>
			        <th>Description</th>
                    <th>Currency</th>
                    <th>Price</th>
			        <th>Category</th>
			        <th><i class="fa fa-bars"></i></th>
			    </tr>
			</thead>
            <tbody>

            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT 
            	                           
											t1.art_id,
                                            t1.art_name,
                                            t1.art_description,
                                            t1.currency,
                                            t1.art_price,
                                            t1.art_path,
                                            t1.art_cat_id,

                                            t2.art_cat_id,
                                            t2.art_cat_name

                                            FROM tbl_art t1
                                            JOIN tbl_art_category t2
            	                           	ON t1.art_cat_id = t2.art_cat_id");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
	            	?>
	                <tr>
	                    <td><?php echo $i; ?></td>
                        <td>
                            <img src="../assets/uploads/<?php echo $row['art_path']; ?>" width="140">
                        </td>
                        <td><?php echo $row['art_name']; ?></td>
                        <td><?php echo $row['art_description']; ?></td>
                        <td><?php echo $row['currency']; ?></td>
                        <td><?php echo $row['art_price']; ?></td>
	                    <td><?php echo $row['art_cat_name']; ?></td>
	                    <td>
	                        <a href="edit-art.php?id=<?php echo $row['art_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="delete-art.php?id=<?php echo $row['art_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
	                    </td>
	                </tr>
	                <?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div> 

</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this Art?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>