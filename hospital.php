<?php
	ob_start();
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MeLife Platform</title>
		<link rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="" name="description">
		<meta content="" name="author">
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css"/>
		<!-- Just for debugging purposes -->
		<script src="bootstrap-3.3.2-dist/js/ie-emulation-modes-warning.js"></script>
		
		<script src="js/jquery-2.1.3.min.js"></script>
		<script src="bootstrap-3.3.2-dist/js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script>
		$(document).ready(function() {
			src = "autocomp1.php";

			// Load the cities straight from the server, passing the country as an extra param
			$("#query").autocomplete({
				source: function(request, response) {
					$.ajax({
						url: src,
						dataType: "json",
						data: {
							term : request.term,
							typee : $('.search-panel span#search_concept').text()
						},
						success: function(data) {
							response(data);
						}
					});
				},
				min_length: 3,
				delay: 300
			});
			});
		$(document).ready(function(e){
			$('.search-panel .dropdown-menu').find('a').click(function(e) {
				e.preventDefault();
				var param = $(this).attr("href").replace("#","");
				var concept = $(this).text();
				$('.search-panel span#search_concept').text(concept);
				$('.input-group #search_param').val(param);
			});
		});	
		</script>
		<style>
			body{
				padding-top:50px;
			}
			/*======================
	DOCTOR PAGE
  ======================*/  
.jst-cov {
    float: left;
    width: 100%;
	padding-bottom:15px;
}
.doctor {
	border-bottom:2px solid #ffe073;
	padding-bottom:16px;
	margin-bottom:40px;
}
.doctor img {
	float:left;
}
.doctor h2 {
	color:#383d48;
	font-weight:800;
	font-size:13.5px;
	text-align:center;
	text-transform:uppercase;
	
}
.doctor h2 span {
	display:block;
	color:#4c6880;
	font-size:13px;
	font-weight:normal;
}
.social-net {
  float: none;
  text-align: center;
  width: 64px;
  height: 30px;
  clear: both;
  margin: 0 auto;
}
.social-net a {
	padding:14px 18px 5px 0;
	float:left;
}
.face-d {
	background:url(../img/icons/face.png) left top no-repeat;
}
.twitt-d {
	background:url(../img/icons/twitt.png) left top no-repeat;
}
.google-d {
	background:url(../img/icons/google.png) left top no-repeat;
}
.face-d:hover {
	background:url(../img/icons/face-hov.png) left top no-repeat;
}
.twitt-d:hover {
	background:url(../img/icons/twitt-hov.png) left top no-repeat;
}
.google-d:hover {
	background:url(../img/icons/google-hov.png) left top no-repeat;
}

.doc > .active , .doc:hover .doctor {
	border-bottom:2px solid #6acff0; 
}
.doc > .doctor h3.active , .doc:hover h3{
	background: #6acff0; 
	color:#fff;
}
/*======================
	DOCTOR PAGE
		</style>

	</head>
	<?php
		include "includes/dbConnector.php";
	?>
	<body>
		<!--\\\\\\\\\\\\\Navigation ber starts here/////////////-->
		<?php
			function navi()
			{
		?>
				<ul class="nav navbar-nav">
					<li><a href="index.php" style="font-size:16px;">Home</a></li>
					<li class="active"><a href="#" style="font-size:16px;">Find Hospital</a></li>
					<li class="dropdown">
					<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;">Doctor Accessories<span class="caret"></span></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="equipments.php" style="font-size:16px;">Equipements</a></li>
						<li><a href="medicines.php" style="font-size:16px;">Medicines</a></li>
					</ul>
					</li>
					<li><a href="Service.php" style="font-size:16px;">Service</a></li>
					<li><a href="blog.php" style="font-size:16px;">Blog</a></li>
					<li><a href="about.php" style="font-size:16px;">About</a></li>
					<li><a href="contact.php" style="font-size:16px;">Contact</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" data-toggle="modal" data-target="#modal-1"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
										
					<li><a href="#" data-toggle="modal" data-target="#modal-2"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
		<?php
			}
		?>
		<div class="navbar-wrapper">
			<div class="container">
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container">
						<div class="navbar-header">
							<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
								<span class="sr-only">Toggle nevigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a href="#" class="navbar-brand" style="font-size:20px;">MeLife</a>
						</div>
						<div class="navbar-collapse collapse" id="navbar">
                    
					<!-- inside it we can put form, list etc anything we want -->
							<?php
								if(isset($_POST['email']))
								{
									$email=$_POST['email'];
									$pass=$_POST['password'];
									$s="select * from users where email=\"$email\" and password=\"$pass\"";
									$result = $conn->query($s);
									if ($result->num_rows!=0) 
									{
										$cur=1;
										if($row = $result->fetch_assoc())
										{ 
											$username=$row["username"];
											$type=$row["type"];
											$_SESSION["username"]=$username;
											$_SESSION["type"]=$type;
											$_SESSION["email"]=$email;
											$_SESSION["password"]=$pass;
											$s="select * from cart where email='".$_SESSION["email"]."'";
											$result = $conn->query($s);
											$cnt=0;
											if ($result->num_rows!=0) 
											{
												while($row = $result->fetch_assoc())
												{ 
													$cnt=$cnt+1;
												}
											}
											$s="select * from notification where rec='".$_SESSION["email"]."' and status=''";
											$result = $conn->query($s);
											$cnt1=0;
											if ($result->num_rows!=0) 
											{
												while($row = $result->fetch_assoc())
												{ 
													$cnt1=$cnt1+1;
												}
											}
							?>
											<ul class="nav navbar-nav">
												<li><a href="index.php" style="font-size:16px;">Home</a></li>
												<li class="active"><a href="#" style="font-size:16px;">Find Hospital</a></li>
												<?php 
													if($type=="doctor")
													{
												?>
														<li><a href="dpanel.php" style="font-size:16px;">Doctor Panel</a></li>
												<?php
													}
												?>
												<li class="dropdown">
													<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;">Doctor Accessories<span class="caret"></span></a>
													<ul role="menu" class="dropdown-menu">
														<li><a href="equipments.php" style="font-size:16px;">Equipements</a></li>
														<li><a href="medicines.php" style="font-size:16px;">Medicines</a></li>
													</ul>
												</li>
												<li><a href="blog.php" style="font-size:16px;">Blog</a></li>
												<li><a href="about.php" style="font-size:16px;">About</a></li>
												<li><a href="contact.php" style="font-size:16px;">Contact</a></li>
											</ul>
											<ul class="nav navbar-nav navbar-right">
											<li><a href="cart.php" style="font-size:16px;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"style="font-size:12px;"><?php echo $cnt;?></span></a></li>
												<li><a href="notification.php" style="font-size:17px;"><span class="glyphicon glyphicon-globe" ></span> Notifications <span class="badge"style="font-size:12px;"><?php echo $cnt1;?></span></a></li>
												<li class="dropdown">
													<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;"><?php echo $_SESSION["username"];?><span class="caret"></span></a>
													<ul role="menu" class="dropdown-menu">
														<p style="text-align:center;"><li><a href="profile.php" style="font-size:16px;text-align:center;">Profile</a></li></p>
														<!--<form method="post">
															<li><a href="index.php" style="font-size:16px;" name="logout" id="logout">Logout</a></li>
														</form>-->
														<li>
															<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
																<p style="text-align:center;"><input name="logout" type="submit" class="btn btn-success" value="Sign Out"></p>
															</form>
														</li>
													</ul>
												</li>
											</ul>
							<?php
										}
									}
									else 
									{
										navi();
							?>
										
										<!-- ///////for wrong password\\\\\\\\
										<div class="container">
											<div class="row" id="error-container">
												 <div class="span12">  
													 <div class="alert alert-error">
														<button type="button" class="close" data-dismiss="alert">?</button>
														 test error message
													 </div>
												 </div>
											</div>
										</div>
										
										<div class="bs-example">
											<div class="alert alert-danger" id="myAlert">
												<a href="#" class="close" data-dismiss="alert">&times;</a>
												<strong>Error!</strong> A problem has been occurred while submitting your data.
											</div>
										</div>
										-->
							<?php
									}
								}
								else if(isset($_POST['logout']))
								{
									$s="select * from cart";
									$result = $conn->query($s);
									$i=0;
									$q=array();
									$med=array();
									if ($result->num_rows!=0) 
									{	
										while($row = $result->fetch_assoc())
										{
											$q[$i]=$row["quan"];
											$med[$i]=$row["med_id"];
											$i=$i+1;
										}
									}
									$sql = "DELETE FROM cart";
									mysqli_query($conn, $sql);
									for($j=0;$j<$i;$j++)
									{
										$s="select quan from medicines where med_id='$med[$j]'";
										$result = $conn->query($s);
										if ($result->num_rows!=0) 
										{	
											if($row = $result->fetch_assoc())
											{
												$quant=$q[$j]+$row["quan"];
												$sql = "UPDATE medicines SET quan=\"$quant\" WHERE med_id='$med[$j]'";
												$conn->query($sql);
											}
										}
									}
									// remove all session variables
									session_unset();

									// destroy the session
									session_destroy(); 
									navi();
									header('Location: index.php');
								}
								else  if(isset($_POST['regemail']))
								{
									$email=$_POST['regemail'];
									$username=$_POST['username'];
									if(isset($_POST['type']))
									{
										$type=$_POST['type'];
									}
									else $type="";
									$pass=$_POST['password'];
									$s="select * from users where email=\"$email\" OR username=\"$username\"";
									$result = $conn->query($s);
									if ($result->num_rows!=0||$type=="") 
									{
										navi();
									}
									else
									{
										$_SESSION["username"]=$username;
										$_SESSION["type"]=$type;
										$_SESSION["email"]=$email;
										$_SESSION["password"]=$pass;
										$s="INSERT INTO users (username,email,password,type) VALUES('$username','$email','$pass','$type')";
										$conn->query($s);
										$s="select * from cart where email='".$_SESSION["email"]."'";
										$result = $conn->query($s);
										$cnt=0;
										if ($result->num_rows!=0) 
										{
											while($row = $result->fetch_assoc())
											{ 
												$cnt=$cnt+1;
											}
										}
										$s="select * from notification where rec='".$_SESSION["email"]."' and status=''";
										$result = $conn->query($s);
										$cnt1=0;
										if ($result->num_rows!=0) 
										{
											while($row = $result->fetch_assoc())
											{ 
												$cnt1=$cnt1+1;
											}
										}
							?>				
										<ul class="nav navbar-nav">
												<li><a href="index.php" style="font-size:16px;">Home</a></li>
												<li class="active"><a href="#" style="font-size:16px;">Find Hospital</a></li>
												<?php 
													if($type=="doctor")
													{
												?>
														<li><a href="dpanel.php" style="font-size:16px;">Doctor Panel</a></li>
												<?php
													}
												?>
												<li class="dropdown">
													<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;">Doctor Accessories<span class="caret"></span></a>
													<ul role="menu" class="dropdown-menu">
														<li><a href="equipments.php" style="font-size:16px;">Equipements</a></li>
														<li><a href="medicines.php" style="font-size:16px;">Medicines</a></li>
													</ul>
												</li>
												<li><a href="blog.php" style="font-size:16px;">Blog</a></li>
												<li><a href="about.php" style="font-size:16px;">About</a></li>
												<li><a href="contact.php" style="font-size:16px;">Contact</a></li>
											</ul>
											<ul class="nav navbar-nav navbar-right">
											<li><a href="cart.php" style="font-size:16px;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"style="font-size:12px;"><?php echo $cnt;?></span></a></li>
												<li><a href="notification.php" style="font-size:17px;"><span class="glyphicon glyphicon-globe" ></span> Notifications <span class="badge"style="font-size:12px;"><?php echo $cnt1;?></span></a></li>
												<li class="dropdown">
													<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;"><?php echo $_SESSION["username"];?><span class="caret"></span></a>
													<ul role="menu" class="dropdown-menu">
														<p style="text-align:center;"><li><a href="profile.php" style="font-size:16px;text-align:center;">Profile</a></li></p>
														<!--<form method="post">
															<li><a href="index.php" style="font-size:16px;" name="logout" id="logout">Logout</a></li>
														</form>-->
														<li>
															<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
																<p style="text-align:center;"><input name="logout" type="submit" class="btn btn-success" value="Sign Out"></p>
															</form>
														</li>
													</ul>
												</li>
											</ul>
							<?php
									}
								}
								else if(isset($_SESSION['username']))
								{
									$s="select * from cart where email='".$_SESSION["email"]."'";
									$result = $conn->query($s);
									$cnt=0;
									if ($result->num_rows!=0) 
									{
										while($row = $result->fetch_assoc())
										{ 
											$cnt=$cnt+1;
										}
									}
									$s="select * from notification where rec='".$_SESSION["email"]."' and status=''";
									$result = $conn->query($s);
									$cnt1=0;
									if ($result->num_rows!=0) 
									{
										while($row = $result->fetch_assoc())
										{ 
											$cnt1=$cnt1+1;
										}
									}
							?>
										<ul class="nav navbar-nav">
											<li><a href="index.php" style="font-size:16px;">Home</a></li>
											<li class="active"><a href="#" style="font-size:16px;">Find Hospital</a></li>
											<?php 
												if($_SESSION['type']=="doctor")
												{
											?>
													<li><a href="dpanel.php" style="font-size:16px;">Doctor Panel</a></li>
											<?php
												}
											?>
											<li class="dropdown">
											<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;">Doctor Accessories<span class="caret"></span></a>
											<ul role="menu" class="dropdown-menu">
												<li><a href="equipments.php" style="font-size:16px;">Equipements</a></li>
												<li><a href="medicines.php" style="font-size:16px;">Medicines</a></li>
											</ul>
											</li>
											<li><a href="blog.php" style="font-size:16px;">Blog</a></li>
											<li><a href="about.php" style="font-size:16px;">About</a></li>
											<li><a href="contact.php" style="font-size:16px;">Contact</a></li>
										</ul>
										<ul class="nav navbar-nav navbar-right">
										<li><a href="cart.php" style="font-size:16px;"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="badge"style="font-size:12px;"><?php echo $cnt;?></span></a></li>
												<li><a href="notification.php" style="font-size:17px;"><span class="glyphicon glyphicon-globe" ></span> Notifications <span class="badge"style="font-size:12px;"><?php echo $cnt1;?></span></a></li>
												<li class="dropdown">
													<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;"><?php echo $_SESSION["username"];?><span class="caret"></span></a>
													<ul role="menu" class="dropdown-menu">
														<p style="text-align:center;"><li><a href="profile.php" style="font-size:16px;text-align:center;">Profile</a></li></p>
														<!--<form method="post">
															<li><a href="index.php" style="font-size:16px;" name="logout" id="logout">Logout</a></li>
														</form>-->
														<li>
															<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
																<p style="text-align:center;"><input name="logout" type="submit" class="btn btn-success" value="Sign Out"></p>
															</form>
														</li>
													</ul>
												</li>
											</ul>
							<?php
								}
								else
								{
									navi();
								}
							?>
						</div>
					</div>
				</nav>	
			</div>
		</div>
		
		<!--\\\\\\\\\\\\\Navigation ber ends here/////////////-->
		
		<!--\\\\\\\\\\\\\\start//////////////////////////////-->
		
		<div class="container" style="margin-top:40px;">
			<h2>Search the hospitals Wherever in Rwanda</h2>
			<br>
			<p style="font-size:16px;">MeLife platform is an easy way to find physicians information in Rwanda from different hospitals. You can easily choose a hospital and immediately make an appoint.  We are constantly trying to publish accurate and update Rwandan hospitals information. We are committed to improve health care services in Rwanda.</p>
		</div>
		<!--\\\\\\\\\\\\\search bar starts here//////////////-->
		<form role="search" action="hospital.php" role="form"  method="post" enctype="multipart/form-data">
		<div class="container" style="margin-top:40px;">
			<div class="row">    
				<div class="col-xs-8 col-xs-offset-2">
					<div class="input-group">
						<div class="input-group-btn search-panel">
							<button type="button" class="btn btn-beau dropdown-toggle" data-toggle="dropdown">
								<span id="search_concept">Filter by</span> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu">
							  <li><a href="#name">Name</a></li>
							  <li><a href="#specialty">Specialty</a></li>
							</ul>
						</div>
						<input type="hidden" name="search_param" value="all" id="search_param">         
						<input type="text" class="form-control" name="search" placeholder="Search term..." id="query">
						<span class="input-group-btn">
							<button class="btn btn-beau" type="submit"><span class="glyphicon glyphicon-search" style="height:20px;width:65px;font-size:20px;"></span></button>
						</span>
					</div>
				</div>
			</div>
		</div>
		</form>
		<!--\\\\\\\\\\\\\search bar ends here//////////////-->
		
		<!--\\\\\\\\\\\\\sign up form starts here/////////////-->
		
		<div class="modal fade" id="modal-1" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="border-bottom:none">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
                        <h1 class="modal-title">MeLife</h1>
                    </div>
                    <div class="modal-body" style="border-top:none">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#section-1" data-toggle="tab" id="tabbeauty">Sign Up</a></li>
							<li><a href="#section-2" data-toggle="tab" id="tabbeauty">Log In</a></li>
						</ul>
                        <div class="tab-content">
							<div class="tab-pane fade in active" id="section-1">
								<br><br>
								<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
									<div class="form-group" style="padding-left:59px;">
										<input type="text" name="regemail" id="form-elem-8" class="form-control" placeholder="Email address" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="text" name="username" id="form-elem-9" class="form-control" placeholder="Username" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="password" name="password" id="form-elem-10" class="form-control" placeholder="Password" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<select id="company" class="form-control" style="width:182px;" name="type">
										  <option value="" disabled selected>User Type</option> 
										  <option value="doctor">Doctor</option>
										  <option value="member">Member</option>
										</select> 
									</div><br><br>
									<p style="text-align:center;"><input type="submit" class="btn btn-success btn-lg" value="Create An Account"></p>
								</form>
							</div>
							<div class="tab-pane fade" id="section-2">
								<br><br>
								<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
									<div class="form-group" style="padding-left:59px;">
										<input type="text" id="form-elem-6" name="email" class="form-control" placeholder="Email address" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="password" id="form-elem-7" name="password" class="form-control" placeholder="Password"style="height:46px;width:449px">
									</div><br><br>
									<span style="padding-left:59px;">
										<input type="checkbox">Remember me 
										<a href="" style="text-decoration:none;padding-left:200px;">Forgot your password?</a>
									</span><br><br>
									<p style="text-align:center;"><input type="submit" class="btn btn-success btn-lg" value="Log In" data-toggle="modal" data-target="#modal-3"></p>
								</form>
							</div>
						</div>
					</div>
                    <div class="modal-footer" style="padding-right:70px;padding-bottom:50px;">
						<p style="padding-right:180px;color:gray;">Or connect with</p>
						<div class="row">
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupFacebook" class="btn btn-facebook btn-social" style="padding-top:10px;height:41px;width:97px;">Facebook</a>
							</div><!-- /.col-lg-4 -->
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupGoogle" class="btn btn-google btn-social" style="padding-top:10px;height:41px;width:97px;">Google</a>
							</div><!-- /.col-lg-4 -->
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupGithub" class="btn btn-github btn-social" style="padding-top:10px;height:41px;width:97px;"> GitHub</a>
							</div><!-- /.col-lg-4 -->
						</div><!-- /.row -->
					</div><!-- /.container -->
				</div>
			</div>
		</div>
		
		<!--\\\\\\\\\\\\\sign up form ends here/////////////-->
		
		<!--\\\\\\\\\\\\\Log In form starts here/////////////-->
		
		<div class="modal fade" id="modal-2" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="border-bottom:none">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<br>
                        <h1 class="modal-title">MeLife</h1>
                    </div>
                    <div class="modal-body" style="border-top:none">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#section-3" data-toggle="tab" id="tabbeauty">Log In</a></li>
							<li><a href="#section-4" data-toggle="tab" id="tabbeauty">Sign Up</a></li>
						</ul>
                        <div class="tab-content">
							<div class="tab-pane fade in active" id="section-3">
								<br><br>
								<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
									<div class="form-group" style="padding-left:59px;">
										<input type="text" id="form-elem-6" name="email" class="form-control" placeholder="Email address" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="password" id="form-elem-7" name="password" class="form-control" placeholder="Password"style="height:46px;width:449px">
									</div><br><br>
									<span style="padding-left:59px;">
										<input type="checkbox">Remember me 
										<a href="" style="text-decoration:none;padding-left:200px;">Forgot your password?</a>
									</span><br><br>
									<p style="text-align:center;"><input type="submit" class="btn btn-success btn-lg" value="Log In" data-toggle="modal" data-target="#modal-3"></p>
								</form>
							</div>
							<div class="tab-pane fade" id="section-4">
								<br><br>
								<form action="hospital.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
									<div class="form-group" style="padding-left:59px;">
										<input type="text" name="regemail" id="form-elem-8" class="form-control" placeholder="Email address" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="text" name="username" id="form-elem-9" class="form-control" placeholder="Username" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<input type="password" name="password" id="form-elem-10" class="form-control" placeholder="Password" style="height:46px;width:449px">
									</div><br><br>
									<div class="form-group" style="padding-left:59px;">
										<select id="company" class="form-control" style="width:182px;" name="type">
										  <option value="" disabled selected>User Type</option> 
										  <option value="doctor">Doctor</option>
										  <option value="member">Member</option>
										</select> 
									</div><br><br>
									<p style="text-align:center;"><input type="submit" class="btn btn-success btn-lg" value="Create An Account"></p>
								</form>
							</div>
						</div>
					</div>
                    <div class="modal-footer" style="padding-right:70px;padding-bottom:50px;">
						<p style="padding-right:180px;color:gray;">Or connect with</p>
						<div class="row">
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupFacebook" class="btn btn-facebook btn-social" style="padding-top:10px;height:41px;width:97px;">Facebook</a>
							</div><!-- /.col-lg-4 -->
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupGoogle" class="btn btn-google btn-social" style="padding-top:10px;height:41px;width:97px;">Google</a>
							</div><!-- /.col-lg-4 -->
							<div class="col-lg-4">
								<a data-attr2="Login" data-attr1="master" data-analytics="SignupGithub" class="btn btn-github btn-social" style="padding-top:10px;height:41px;width:97px;"> GitHub</a>
							</div><!-- /.col-lg-4 -->
						</div><!-- /.row -->
					</div><!-- /.container -->
				</div>
			</div>
		</div>
		
		<!--\\\\\\\\\\\\\Log In form ends here/////////////-->
		
		<!--\\\\\\\\\\\\\\Hospital starts here///////////////-->
		<div class="demo-area"  style="margin-top:40px;margin-left:285px;">
            <div class="container">
				<?php
					/*$i=0;
					$name=array();
					$img=array();
					$expertise=array();
				
					if(isset($_POST['search']))
					{
						$t=0;
						$s="select * from hospital where name LIKE'%".$_POST['search']."%'";
						if(isset($_POST['search_param']))
						{
							/*if($_POST['search_param']=="specialty")
							{
								$s="select * from hospital_specialty where  expertise LIKE'".$_POST['search']."%' and id_Hsp=id_hosp";
							}*/
						   /*if($_POST['search_param']=="name")
							{
								$s="select * from hospital where name LIKE'".$_POST['search']."%'";
							}
							else
							{
								$result = $conn->query($s);
								if ($result->num_rows!=0) 
								{
									$t=1;
									while($row = $result->fetch_assoc())
									{ 
										$hosp_id[$i]=$row["id"];
										$name[$i]=$row["name"];
										$img[$i]=$row["img"];
										$i=$i+1;
									}
								}
								/*else
								{
									$s="select * from hospital where  expertise LIKE'".$_POST['search']."%'";
								}*/
							/*}
						}
						$result = $conn->query($s);
						if ($result->num_rows!=0&&$t==0) 
						{
							while($row = $result->fetch_assoc())
							{ 
								$d_id[$i]=$row["d_id"];
								$name[$i]=$row["name"];
								$qual[$i]=$row["qualification"];
								$desig[$i]=$row["designation"];
								$expert[$i]=$row["expertise"];
								$organ[$i]=$row["organization"];
								$cham[$i]=$row["chamber"];
								$loca[$i]=$row["location"];
								$phn[$i]=$row["phn"];
								$mail[$i]=$row["email"];
								$i=$i+1;
							}
						}
						else if($t==0)
						{
						?>
						<h2 style="color:red;">Result not found!!!</h2>
						<br><br><br><br><br>
						<?php
						}
					}
					else
					{
						$s="select * from doctors";
						$result = $conn->query($s);
						if ($result->num_rows!=0) 
						{
							while($row = $result->fetch_assoc())
							{ 
								$d_id[$i]=$row["d_id"];
								$name[$i]=$row["name"];
								$qual[$i]=$row["qualification"];
								$desig[$i]=$row["designation"];
								$expert[$i]=$row["expertise"];
								$organ[$i]=$row["organization"];
								$cham[$i]=$row["chamber"];
								$loca[$i]=$row["location"];
								$phn[$i]=$row["phn"];
								$mail[$i]=$row["email"];
								$i=$i+1;
							}
						}
					}
					for($j=0;$j<$i;$j++)
					{
			?>
                <div class="panel panel-default panel-default" style="width:750px;">
					<div class="panel-heading"><h4 class="panel-title">Doctor's Information</h4> </div>
                    <table class="table">
                        <tr>
                            <td>Doctor's Name :</td>
                            <td><?php echo $name[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Qualification :</td>
                            <td><?php echo $qual[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Designation :</td>
                            <td><?php echo $desig[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Expertise :</td>
                            <td><?php echo $expert[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Organization :</td>
                            <td><?php echo $organ[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Chamber :</td>
                            <td><?php echo $cham[$j];?></td>

                        </tr>
						
						
						<tr>
                            <td>Location :</td>
                            <td><?php echo $loca[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Phone :</td>
                            <td><?php echo $phn[$j];?></td>

                        </tr>
						
						<tr>
                            <td>Email :</td>
                            <td><?php echo $mail[$j];?></td>

                        </tr>


                    </table>
					<?php
					if(isset($_SESSION['username'])&&$mail[$j]!=$_SESSION["email"])
					{
					?>
					<div class="panel-footer" style="text-align: center;padding-top:22px;">
						<form role="search" action="Make Appointment.php" role="form"  method="post" enctype="multipart/form-data">
							<button class="btn btn-beau" type="submit" name="Make Appointment" value=<?php echo $d_id[$j];?>>Request Make Appointment<span class="glyphicon glyphicon-hand-right" style="padding-left:10px;"></span></button>
						</form>
					</div>
					<?php
					}
					?>
                </div>
				<?php
					}
				*/?>
				

            </div>
        </div>
		
        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
           <h2>KIGALI HOSPITAL
		     <span><input type="button" value="Make Appointment" name="btn"></span></h2>
			 </a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
          <h2>KIGALI HOSPITAL
		   <span><input type="button" value="Make Appointment" name="btn"></span></h2>
		   </a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
            <h2>KIGALI HOSPITAL
			 <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
           <h2>KIGALI HOSPITAL
		    <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
           <h2>KIGALI HOSPITAL
		    <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
         <h2>KIGALI HOSPITAL
		  <span><input type="button" value="Make Appointment" name="btn"></span><h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
            <h2>KIGALI HOSPITAL
			 <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
            <h2>KIGALI HOSPITAL
			 <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
            <h2>KIGALI HOSPITAL
			 <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->

        <div class="col-sm-3 doc">
        <div class="doctor">
        	<a href="appointment.php"><img src="img/kigali.jpg" alt="263">
            <div class="social-net">
            	<a href="Doctors.php#" class="face-d"></a>
                <a href="Doctors.php#" class="twitt-d"></a>
                <a href="Doctors.php#" class="google-d"></a>
            </div><!-- /.social-net -->
            <h2>KIGALI HOSPITAL
			 <span><input type="button" value="Make Appointment" name="btn"></span></h2></a>
			
        </div><!-- /.doctor -->
    	</div><!-- /.col-sm-3 -->
    </div><!-- /.row -->
    </div><!-- /.container -->
    </div><!-- /.first-section -->
     <!--==================================
       		news section parts ends here
          ==================================-->
		
		<!--\\\\\\\\\\\\\\doctor starts here///////////////-->
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<?php
			include "includes/footer.php";
		?>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		
		<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
		<script src="bootstrap-3.3.2-dist/js/docs.min.js"></script>
		<script src="js/myjs.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="bootstrap-3.3.2-dist/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>