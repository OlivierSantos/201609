<?php
	error_reporting(1);
	ob_start();
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>MeLife</title>
		<link rel="stylesheet" href="css/style.css"/>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="" name="description">
		<meta content="" name="author">
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="bootstrap-3.3.2-dist/css/bootstrap-theme.min.css"/>
		<!-- Just for debugging purposes -->
		<script src="bootstrap-3.3.2-dist/js/ie-emulation-modes-warning.js"></script>
		<script src="bootstrap-3.3.2-dist/js/jquery.min.js"></script>
		<script src="js/jquery-1.7.1.min.js"></script>
		<script src="js/myjs.js"></script>
		<style type="text/css"> 
			body{
				padding-top:50px;
			}
			.bs-example{
				margin: 20px;
			}
			#error-container {
				 margin-top:100px;
				 position: fixed;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".close").click(function(){
					$("#myAlert").alert();
				});
			});
		</script>
		<script language="javascript" type="text/javascript">
			$(document).ready(function()
			{
				$("#checkall").live('click',function(event){
					$('input:checkbox:not(#checkall)').attr('checked',this.checked);
					//To Highlight
					if ($(this).attr("checked") == true)
					{
						//$(this).parents('table:eq(0)').find('tr:not(#chkrow)').css("background-color","#FF3700");
						$("#tblDisplay").find('tr:not(#chkrow)').css("background-color","#c6c3c3");
					}
					else
					{
						//$(this).parents('table:eq(0)').find('tr:not(#chkrow)').css("background-color","#fff");
						$("#tblDisplay").find('tr:not(#chkrow)').css("background-color","#FFF");
					}
				});
				$('input:checkbox:not(#checkall)').live('click',function(event){
					if($("#checkall").attr('checked') == true && this.checked == false)
					{
						$("#checkall").attr('checked',false);
						$(this).closest('tr').css("background-color","#c6c3c3");
					}
					if(this.checked == true)
					{
						$(this).closest('tr').css("background-color","#c6c3c3");
						CheckSelectAll();
					}
					if(this.checked == false)
					{
						$(this).closest('tr').css("background-color","#ffffff");
					}
				});

				function CheckSelectAll(){
					var flag = true;
					$('input:checkbox:not(#checkall)').each(function(){
						if(this.checked == false)
						flag = false;
					});
					$("#checkall").attr('checked',flag);
					}
				});

		</script>
		<?php
			include "includes/dbConnector.php";
		?>
	</head>
	<body>
	<!--\\\\\\\\\\\\\Navigation ber starts here/////////////-->
		<?php
		if(isset($_POST['logout']))
		{
			// remove all session variables
			session_unset();

			// destroy the session
			session_destroy(); 
			header('Location: adminlogin.php');
		}
		$s="select * from notification where rec='admin' and status=''";
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
							<ul class="nav navbar-nav">
								<li class="active"><a href="HospitalAppointment.php" style="font-size:16px;">Appointments list</a></li>
								<li><a href="doctorList.php" style="font-size:16px;">Doctors list</a></li>
								<li class="dropdown">
									<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="doctorSchedule.php" style="font-size:16px;">Doctors Schedule<span class="caret"></span></a>
			
								</li>
								<li><a href="#" style="font-size:16px;"><span class="glyphicon glyphicon-envelope" ></span> Notifications<span class="badge"style="font-size:12px;"><?php echo $cnt1;?></span></a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a aria-expanded="false" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#" style="font-size:16px;">Admin<span class="caret"></span></a>
									<ul role="menu" class="dropdown-menu">
										<li>
											<form action="adminapp.php" role="form" class="form-inline" method="post" enctype="multipart/form-data">
												<p style="text-align:center;margin-top:20px;"><input name="logout" type="submit" class="btn btn-success" value="Sign Out"></p>
											</form>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>	
			</div>
		</div>
		
		<!--\\\\\\\\\\\\\Navigation ber ends here/////////////-->
<!--\\\\\\\\\\\\\\doctor starts here///////////////-->
		<div class="demo-area"  style="margin-top:40px;margin-left:285px;">
            <div class="container">
				<?php
					$i=0;
					$name=array();
					$qual=array();
					$desig=array();
					$expert=array();
					$organ=array();
					$cham=array();
					$loca=array();
					$phn=array();
					$mail=array();
					$d_id=array();
					if(isset($_POST['search']))
					{
						$t=0;
						$s="select * from doctors where name LIKE'%".$_POST['search']."%'";
						if(isset($_POST['search_param']))
						{
							if($_POST['search_param']=="specialty")
							{
								$s="select * from doctors where  expertise LIKE'".$_POST['search']."%'";
							}
							else if($_POST['search_param']=="name")
							{
								$s="select * from doctors where name LIKE'".$_POST['search']."%'";
							}
							else
							{
								$result = $conn->query($s);
								if ($result->num_rows!=0) 
								{
									$t=1;
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
								else
								{
									$s="select * from doctors where  expertise LIKE'".$_POST['search']."%'";
								}
							}
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
					<?php
					}
					?>
                </div>
				<?php
					}
				?>

            </div>
        </div>
		<div class="panel-footer" style="text-align: center;padding-top:22px;">
						<form role="search" action="appointment.php" role="form"  method="post" enctype="multipart/form-data">
							<button class="btn btn-beau" type="submit" name="appointment" >Add a New Doctor<span class="glyphicon glyphicon-hand-right" style="padding-left:10px;"></span></button>
						</form>
					</div>
		
		<!--\\\\\\\\\\\\\\doctor starts here///////////////-->

			<!-- FOOTER -->	
			
		</div><!-- /.container -->
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