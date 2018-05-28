<?php

if (!isset($_POST["submit"])) {
	$host = "Your Host/IP";
	$port = "Your Port";
	$status = '<span class="label label-success">Online</span> or <span class="label label-danger">Offline</span>';
	$response = 0;
} else {
	$host = $_POST['host'];
	$port = $_POST['port'];
	$status = '<span class="label label-danger">Not Valid</span>';
	$response = getStatus($host, $port);
	//validation
	if (!is_numeric($port) || $port < 0 || $port > 65535) {
		echo '<meta http-equiv="refresh" content="0" />';
		echo '<script>alert("Port is not Valid")</script>';
	}else{
		if ($response > 0) {
			$status = '<span class="label label-success">Online</span>';
		} else {
			$status = '<span class="label label-danger">Offline</span>';
		}
	}
}


function getStatus($host, $port)
{
	$start_time = microtime(TRUE);
	$timeout = 2;
	$socket = @fsockopen($host, $port, $errorNo, $errorStr, $timeout);
	if (!$socket) {
		return 0;
	}
	else {
		$end_time = microtime(TRUE);
		$time_taken = $end_time - $start_time;
		$time_taken = round($time_taken,5);
		return $time_taken * 1000;
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>

</head>
<!-- <body background="http://siakad.esaunggul.ac.id/front/gate/images/bg/bg_14.png"> -->
<body style="display: flex; flex-direction: column; height: 100vh;">
<div class="container" style="flex: 1">
	<center><h2><b>Simple PHP Server Checker</b></h2><br></center>
	<div class="col-md-8 col-md-offset-3">
	<form class="form-inline" action="" method="post">
    <div class="form-group">
      <label for="host">Host:</label>
      <input type="host" class="form-control" id="host" placeholder="Enter host/ip" name="host" required>
    </div>
    <div class="form-group">
      <label for="port">Port:</label>
      <input type="text" class="form-control" id="port" placeholder="Enter port" name="port" required>
    </div>
    <button name="submit" class="btn btn-default" id="submit" >Submit</button>
	</form><br>
	</div>

	<div class="col-sm-12 col-md-10 col-md-offset-1">
	<table class="table table-bordered">
		<tr>
			<th class="text-center">Host/IP</th>
			<th class="text-center">Port</th>
			<th class="text-center">Status</th>
			<th class="text-center">Response Time</th>
		</tr>
		<tr>
			<td class="text-center"><?= $host ?></td>
			<td class="text-center"><?= $port ?></td>
			<td class="text-center"><?= $status ?></td>
			<td class="text-center"><?= $response ?> ms</td>
		</tr>
	</table>
	</div>
</div>

<footer style="width: 100%; text-align: center;">
    <a href="http://fb.com/AndreDoankz" target="_blank"><i class="fa fa-facebook"></i></a>
    <a href="http://twitter.com/AndreSuntoro" target="_blank"><i class="fa fa-twitter"></i></a>
    <a href="http://instagram.com/AndreSuntoro" target="_blank"><i class="fa fa-instagram"></i></a>
    <a href="http://linkedin.com/in/AndreSuntoro" target="_blank"><i class="fa fa-linkedin"></i></a>
    <p>Made with ❤ by <a href="https://github.com/andresuntoro">Andre Suntoro </a></p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>
</html>