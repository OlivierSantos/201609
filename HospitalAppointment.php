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

		<div class="container">	

			<section class="shopping-cart"><br>
			<h2 class="title" style="font-size:18px;text-align:center;">Today Hospital Appointments</h2>
			<?php
				$i=0;
					
				$ap_id=array();
				$uFirsame=array();
				$uLastsame=array();
				$userPhone=array();
				$userEmail=array();
				$address=array();
				$s="select * from appointments";
			    $result = $conn->query($s);
				if ($result->num_rows!=0) 
							{
								
								while($row = $result->fetch_assoc())
								{
									$ap_id[$i]=$row['id'];
									$uFirsame[$i]=$row['firstName'];
									$uLastame[$i]=$row['LastName'];
									$address[$i]=$row['Address'];
									$userPhone[$i]=$row['phone'];
									$userEmail[$i]=$row['email'];
									$i=$i+1;
								}
							}
							
					
					
					?>
					
				
		      	<br>
			
			<table class="items-list" id="tblDisplay">
			    <tr class="item">
			    <th style=" ">NO</th> 
				  
				<th style=" ">Patient Name</th>
				<th style="font-size:14px;">Patient Address</th>
			  <th style="font-size:14px;">Patient Phone</th>
			  <th style="font-size:14px;">Patient email</th>
			  <th style="font-size:14px;">Status</th>
			  <th style="font-size:14px;">Payment</th>
			</tr>
					<!--Item-->
					<?php
						
						for($j=0;$j<$i;$j++)
						{
								
					?>
					
					<tr class="item">
					  <td style="font-size:14px;"><?php echo $j+1;?></td>
					  <td style="font-size:14px;"><?php echo $uFirsame[$j]."  ".$uLastame[$j];?></td>
					  <td style="font-size:14px;"><?php echo $address[$j];?></td>
					  <td style="font-size:14px;"><?php echo $userPhone[$j];?></td>
					  <td style="font-size:14px;"><?php echo $userEmail[$j];?></td>
					  <td style="font-size:14px;"></td>
					  <td style="font-size:14px;"></td>
					  <td style="font-size:14px;"></td>
					
					  
					  </tr>
					
					  <?php
						}
					?>
					
						</table>  
      </section>	
		</div><!-- /.container -->
		<!--doctor's panel ends here-->
		
		<!-- FOOTER Starts Here-->
		
		<link href="css/font-awesome.min.css" rel="stylesheet">
	<?php
		include "includes/footer.php";
	?>
		<!--/.footer Ends Here-->
		
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
		<script src="bootstrap-3.3.2-dist/js/docs.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="bootstrap-3.3.2-dist/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>