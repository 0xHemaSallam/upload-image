<!DOCTYPE html>
<html>
<head>
	<title>Upload File</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>

<h1 class="col text-center bg-success p-2">Upload File Using PHP</h1>


<div class="container">
	<div class="row">
		<form class="col-sm-6" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >

		    <div class="form-group">
			    <label >Image</label>
			    <input type="file" name="image"  class="form-control"  >
		    </div>

		     <div class="form-group">
			   	<hr>
		    </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>


		<div class="col-sm-6">
                <?php 
                $error = '';
                $success = '';

                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $file = $_FILES['image'];
                    $f_name = $file['name'];
                    $f_type = $file['type'];
                    $f_temp_name = $file['tmp_name'];
                    $f_error = $file['error'];
                    $f_size = $file['size'];
                    if($f_name !=  ''){
                        $ext = pathinfo($f_name);
                        $original_name = $ext['filename'];
                        $original_ext = $ext['extension'];
                        $allowed = array("png","jpg","jpeg","gif","pdf");
                        if(in_array($original_ext,$allowed)){
                            if($f_error === 0)
                            {
                                if($f_size < 1000000)
                                {
                                    $new_name = uniqid('', true).".".$original_ext;
                                    $destnation = "uploads/".$new_name;
                                    move_uploaded_file($f_temp_name, $destnation);
                                    $success = "Your File Have Been Upload";
                                }
                                else
                                {
                                    $error = "Your FILE Bigger Than 5 MB";
                                }
                            }
                            else
                            {
                                $error = "You Have an Error";
                            }

                        }
                        else
                        {
                            $error = "Your File Not Allowed";
                        }

                    }
                    else
                    {
                        $error = "Please Choose Image";
                    }
                }

                ?>
            <?php if($error != ''){ ?>
				<h4 class="alert alert-danger col text-center"><?= $error; ?></h4>
            <?php }?>
            <?php if($success !=''){?>
				<h4 class="alert alert-success col text-center"><?= $success; ?></h4>  
            <?php }?>
		</div>
	</div>						
</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
</body>
</html>
