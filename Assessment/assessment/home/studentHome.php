<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php

    if (isset($_SESSION['message']) && $_SESSION['message'])
    {
      printf('<b>%s</b>', $_SESSION['message']);
      unset($_SESSION['message']);
    }
  ?>
<?php
// session_start(); 
$message = ''; 
if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload')
{
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK)
  {
    // get details of the uploaded file 
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // sanitize file-name 
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    // check if file has one of the following extensions 
    // $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
    // if (in_array($fileExtension, $allowedfileExtensions))
    {
      // directory in which the uploaded file will be moved 
	  $dir = './uploaded_files/';
if (!file_exists($dir) && !is_dir($dir)) {
    mkdir($dir, 0775, true);
}
    //   $uploadFileDir = './uploaded_files/';
    //   $dest_path = $uploadFileDir . $newFileName;
      if(move_uploaded_file($fileTmpPath, $dir.$newFileName)) 
      {
        $message ='File is successfully uploaded.';
      }
      else 
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
      }
    }
    // else
    // {
    // //   $message = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
    // }
  }
  else
  {
    $message = 'There is some error in the file upload. Please check the following error.<br>';
    $message .= 'Error:' . $_FILES['uploadedFile']['error'];
  }
}
$_SESSION['message'] = $message;
?>

	<?php 
	    include "../includes/header.php";
		include "../includes/student-navbar.php";
		include "../db_handler.php"; 
	?>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css?<?php echo time(); ?> /">
		<link rel="stylesheet" href="css/style1.css?<?php echo time(); ?> /">
		<link rel="stylesheet" href="css/tile.css?<?php echo time(); ?> /">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script> 
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/css/bootstrap-slider.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.7.2/bootstrap-slider.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
		<title>Home</title>
	</head>
	<body>
	<div class="container">
    <div class="row">
        <form class="form-horizontal" style="float: right;" action="" method="post" name="export" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-md-4 col-md-offset-4">
              <input type="submit" name="export" class="btn btn-success" value="Export As CSV File"/>
            </div>
          </div>     
		  </form> 
    	<h1>Assingments</h1>
    	<hr>
            <div class="row">
        <div class="col-md-6 col-md-offset-0">
            <form enctype="multipart/form-data" method="post" action="">
                <div class="form-group">
                    <label for="file">Submit your Assingment</label>
                    <input type="file" class="form-control" name="uploadedFile" >
                </div>
                <div class="form-group">
                    <?php echo $message; ?>
                </div>
                <div class="pull-right" style="margin-top: -50px; margin-right: -85px;">
                    <input type="submit" name="uploadBtn" class="btn btn-primary" value="Upload">
                </div>
            </form>
			<object data="./uploaded_files/<?=$newFileName?>" type="application/pdf" width="100%" height="100">
  <p>It appears you don't have a PDF plugin for this browser.
  No biggie... you can <a href="./uploaded_files/<?=$newFileName?>">click here to
  download the PDF file.</a></p>
</object>
		<div class="container">
			<div class="wrapper">
			<h1>Welcome
			<?php 
				$user = $_SESSION['id'];
				$sql = "SELECT * FROM users WHERE username = '$user'"; 
				$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			
		        while($row = mysqli_fetch_array($result)) { 
		        	$name = $row['name'];
					echo " " . $name . " (Student)";
				}
			?>
		</h1>
		<hr>
			<h3>Modules You Are Enrolled For</h3>
            <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Modules:</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Module Leader</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
                    	$user = $_SESSION['id']; 				
						$sql = "SELECT level FROM users WHERE username = '$user'"; 

						$res = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

						$level = $test['level']; // SAVES THE ARRAY AS A STRING
						$query = "SELECT * FROM module WHERE level = '$level'"; // SEARCHES THE 'module' TABLE BASED ON THE 'level' IN 'users' TABLE

						$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

						$output = '';				
				        while($row = mysqli_fetch_array($result)) {                               
	                    	$output .= '
	                    	<tr>
	                        	<td>'.$row["module_code"].'</td>
	                            <td>'.$row["module_name"].'</td>';

	                            $lid = $row["module_leader"];

	                            $asql2 = "SELECT name, surname FROM users WHERE id = '$lid'";
								$res1 = mysqli_query($conn, $asql2) or die(mysqli_error($conn));

	                            while($arow = mysqli_fetch_array($res1)) {
			                    	$output .= '
			                            <td>'.$arow["name"].' '.$arow["surname"].'</td>
			                          ';
			                    }

	                            $output .= '		                            
	                            	<td>'.$row["description"].'</td>
                        	</tr>                    
                          ';

	                    }
	                    echo $output;
                    ?>
                    </tbody>
                </table>
            </div>
            <hr>
			<h3>Marks and Feedback</h3>
            <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
            <div class="panel-heading" style="background-color: #00bdaa;">
                <h3 class="panel-title">Marks:</h3>
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Assessment Name</th>
                        <th>Mark</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                	<?php  				
						$user = $_SESSION['id'];
						$query = "SELECT id FROM users WHERE username = '$user'";
						
						$res = mysqli_query($conn, $query); // SAVES 'sql' QUERY RESULT
						$test = mysqli_fetch_array($res); // FETCHES THE DATA FROM THAT RESULT

						$sid = $test['id']; // SAVES THE ARRAY AS A STRING

						$sql = "SELECT module_code, sub_assessment, final_mark, feedback FROM marks WHERE student_id = '$sid'"; 
						$result = mysqli_query($conn, $sql) ;

						$check = mysqli_query($conn, $sql); // SAVES 'sql' QUERY RESULT
						$acheck = mysqli_fetch_array($check); // FETCHES THE DATA FROM THAT 

						$mcode = $acheck['module_code'];

						$state = "SELECT module_name FROM module WHERE module_code = '$mcode'";
						$aresult = mysqli_query($conn, $state);

						$acode = $acheck['sub_assessment'];

						$astate = "SELECT sub_assessment FROM assessment WHERE sub_assessment = '$acode'";
						$bresult = mysqli_query($conn, $astate);

						$output = '';				
				        while($row = mysqli_fetch_array($result)) {                               
	                    	$output .= '
	                    	<tr>
	                        	<td>'.$row["module_code"].'</td>	                    
	                          ';

	  	                    while($arow = mysqli_fetch_array($aresult)) {                               
		                    	$output .= '
		                            <td>'.$arow["module_name"].'</td>
		                          ';
		                    }

		                    $state = "SELECT module_name FROM module WHERE module_code = '$mcode'";
							$aresult = mysqli_query($conn, $state);

							$acode = $acheck['sub_assessment'];

							$astate = "SELECT sub_assessment FROM assessment WHERE sub_assessment = '$acode'";
							$bresult = mysqli_query($conn, $astate);

		                    $output .= '
		                    	<td>'.$row["sub_assessment"].'</td>
		                    	<td>'.$row["final_mark"].'</td>
		                    	<td>'.$row["feedback"].'</td>
		                    </tr>
		                    ';
	                    }

	                    $sql1 = "SELECT DISTINCT module_code, assessment_code, total_marks, feedback FROM marking_scheme_marks WHERE student_id = '$sid'";
						$result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

						$get = mysqli_query($conn, $sql1); // SAVES 'sql' QUERY RESULT
						$got = mysqli_fetch_array($get); // FETCHES THE DATA FROM THAT 

						$mcode = $got['module_code'];
						$acode = $got['assessment_code'];

						$sql2 = "SELECT module_name FROM module WHERE module_code = '$mcode'";
						$result2 = mysqli_query($conn, $sql2);

						$sql3 = "SELECT name FROM assessment WHERE assessment_code = '$acode'";
						$result3 = mysqli_query($conn, $sql3);

	                    while($row1 = mysqli_fetch_array($result1)) {                               
	                    	$output .= '
	                    	<tr>
	                        	<td>'.$row1["module_code"].'</td>';

	                        	while($arow = mysqli_fetch_array($result2)) {
			                    	$output .= '
			                            <td>'.$arow["module_name"].'</td>
			                          ';
			                    }

			                    while($arow1 = mysqli_fetch_array($result3)) {
			                    	$output .= '
			                            <td>'.$arow1["name"].'</td>
			                          ';
			                    }

	                        	$output .='	                    
		                    	<td>'.$row1["total_marks"].'</td>
		                    	<td>
                                	
                             	</td>
	                    	</tr>
		                    ';
	                    }
	                    echo $output;
                    ?>
                    </tbody>
                </table>
            </div>
		</div>
	</body>
	</div>
</html>

<style type="text/css">
	a, a:hover, a:active, a:visited { 
		color: white;
	}
</style>
<?php

$dir = './uploaded_files/';
$files = array_diff(scandir($dir), array('.', '..'));
foreach($files as $file){
    echo '<a href="'.$dir.$file.'">'.$file.'</a> <br>';
}


?>