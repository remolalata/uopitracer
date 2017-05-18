<?php include'php/header.php'; ?>

<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

<section class="content-header">
  <h1>
    Alumni
  </h1>
  <ol class="breadcrumb">
    <li><a href="dashboard.php"><i class="fa fa-dashboard"> </i> Dashboard</a></li>
    <li class="active">User</li>
  </ol>
</section>

<section class="content">

  <div class="box box-success">

    <div class="box-header with-border text-right">
      <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"> </i> Add Alumni</a>
      <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#importModal"><i class="fa fa-upload"> </i> Import Alumni List</a>
    </div>

    <div class="box-body">
      <table id="alumniTbl" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Student Number</th>
            <th>Name</th>
            <th>Batch</th>
            <th>Course</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = mysqli_query($conn, "select * from tbl_alumni");
            while($row = mysqli_fetch_assoc($query)){
              ?>
                <tr>
                  <td><?php echo $row['student_number']; ?></td>
                  <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                  <td><?php echo $row['year_graduated']; ?></td>
                  <td><?php echo $row['coursecode']; ?></td>
                  <td align="center">
                    <a href="alumni_profile.php?id=<?php echo $row['student_number']; ?>" class="btn btn-primary btn-sm" title="View Alumni"><i class="fa fa-eye"></i></a>
                  </td>
                  <td align="center">
                    <a href="#" class="btn btn-default btn-sm" title="Edit Alumni"><i class="fa fa-pencil"> </i></a>
                  </td>
                  <td align="center">
                    <a href="#" class="btn btn-danger btn-sm" title="Delete Alumni" data-toggle="modal" data-target="#deleteModal" data-no="<?php echo $row['student_number']; ?>"><i class="fa fa-trash"></i></a>
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

<?php
	$excelFile = "import_files/".basename($_FILES["file"]["name"]);
	$fileType = pathinfo($excelFile, PATHINFO_EXTENSION);

	if($fileType != "xls" && $fileType != "xlsx"){
		$_SESSION['alert'] = 4;
    header("Location: alumni_manage.php");
	}else{

		move_uploaded_file($_FILES["file"]["tmp_name"], $excelFile);

		include'PHPExcel/IOFactory.php';
		$objPHPExcel = PHPExcel_IOFactory::load($excelFile);
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
			$highestRow = $worksheet->getHighestRow();
			for ($row=2; $row<=$highestRow ; $row++) { 
				$student_number = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(0, $row) -> getvalue());
				$lastname  = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(1, $row) -> getvalue());
				$firstname = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(2, $row) -> getvalue());
				$middlename = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(3, $row) -> getvalue());
				$email = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(4, $row) -> getvalue());
				$course = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(5, $row) -> getvalue());
        $college = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(6, $row) -> getvalue());
				$year_graduated = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(7, $row) -> getvalue());
        $mobile_number = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(8, $row) -> getvalue());
				$sql = "insert into tbl_alumni(student_number, password, lastname, firstname, middlename, email_add, coursecode, college, year_graduated, mobile_number) value('$student_number', '".md5($lastname)."', '$lastname', '$firstname', '$middlename', '$email', '$course', '$college', '$year_graduated','$mobile_number')";
				mysqli_query($conn, $sql);
			}
		}
	}

  $_SESSION['alert'] = 5;
  header("Location: alumni_manage.php");
?>

<?php include'php/footer.php'; ?>