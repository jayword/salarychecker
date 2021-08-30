<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		<script src="ckeditor.js"></script>
		<link rel="shortcut icon" href="img/logo-small.png" type="img/x-icon">
        <title>ACS</title>

        <!-- Bootstrap Core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="assets/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		
		<script type="javascript">
			function clearform(){
				document.getElementByClass("Form-group").value="";
			}
		</script>
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">ACS Salary Checker</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li><a href="index.php"><i class="fa fa-home fa-fw"></i></a></li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">
                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>User <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>-->
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> User</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <!--<input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                </span>-->
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Check Salary</a>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper" style="margin-top:50px;">
                <div class="row">
                    <div class="col-lg-12">
                        <!--<h1 class="page-header">Forms</h1>-->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 style="color: blue; margin-top: 40px;">Salary Checker</h5>
                            </div>
                            <div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<form class="form-group" method="post" action="index.php">
											<div class="form-group">
												<label>Expected Salary</label>
												<input type="number" min="0" class="form-control" name="salary" placeholder="0" required autofocus />
											</div>
											<hr></hr>
											<div class="form-group">
												<label>ALLOWANCES</label>
											</div>
											<div class="form-group">
												<label>Car Allowance</label>
												<input type="number" min="0" class="form-control" name="car" placeholder="0" required />
											</div>
											<div class="form-group">
												<label>Travel Allowance</label>
												<input type="number" min="0" class="form-control" name="travel" placeholder="0" required />
											</div>
											<div class="form-group">
												<label>Vacation Allowance</label>
												<input type="number" min="0" class="form-control" name="vacation" placeholder="0" required />
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary" name="sender">Check Salary</button>
											</div>
										</form>
									</div>
									<div class="col-lg-8" style="border: 1px solid gray;">
										<h2>Checker Result:</h2>
										<?php 
											if(isset($_POST["sender"])){
												$sal = htmlspecialchars(strip_tags($_POST["salary"]));
												$car = htmlspecialchars(strip_tags($_POST["car"]));
												$travel = htmlspecialchars(strip_tags($_POST["travel"]));
												$vacation = htmlspecialchars(strip_tags($_POST["vacation"]));
											
												$myArr = array(
													"salary" => $sal,
													"car" => $car,
													"travel" => $travel,
													"vacation" => $vacation
												);
												
												$arr_encod = json_encode($myArr);
												
												$cho = curl_init();
						
												curl_setopt_array($cho, array(
												CURLOPT_URL => "http://localhost:80/api/getdata",
												CURLOPT_RETURNTRANSFER => true,
												CURLOPT_ENCODING => "",
												CURLOPT_MAXREDIRS => 10,
												CURLOPT_TIMEOUT => 30,
												CURLOPT_SSL_VERIFYHOST => false,
												CURLOPT_SSL_VERIFYPEER => false,
												CURLOPT_FOLLOWLOCATION => false,
												CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
												CURLOPT_CUSTOMREQUEST => "POST",
												CURLOPT_POSTFIELDS => $arr_encod,
												CURLOPT_HTTPHEADER => array(
													"Content-Type: application/json"
													),
												));
														
												$outer = curl_exec($cho);
												$erri = curl_error($cho);
												curl_close($cho);
												//echo var_dump($outer);
												
												$yummy = json_decode($outer,true);
												
												$expectedsalary = $yummy["expectednetsalary"];
												$netsalary = $yummy["actualNetSalary"];
												$empPension = $yummy["totalEmployeePensionPayable"];
												$employerPension = $yummy["totalEmployerPensionPayable"];
												$payablePayeTax = $yummy["payablePayeTax"];
												$gross_salary = $yummy["gross_salary"];
										?>		
												<table class='table table-bordered table-striped'>
													<thead>
														<tr>
															<th>Expected Net Salary</th>
															<th>Employee Pension</th>
															<th>Employer Pension</th>
															<th>Payable Tax</th>
															<th>Gross Salary</th>
															<th>Actual Net Salary</th>
														</tr>
													</thead>
												
													<tbody>
														<tr>
															<td><?php echo $expectedsalary; ?></td>
															<td><?php echo $empPension; ?></td>
															<td><?php echo $employerPension; ?></td>
															<td><?php echo $payablePayeTax; ?></td>
															<td><?php echo $gross_salary; ?></td>
															<td><?php echo $netsalary; ?></td>
														</tr>
													</tbody>
												</table>
												
										<?php	} ?>
										
										
										
									</div>
								</div>
                                
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
						
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="assets/js/startmin.js"></script>
		
		<script type="text/javascript" src="DataTables/datatables.min.js"></script>
		
		<script>
			$(".table").DataTable();
		</script>

    </body>
</html>