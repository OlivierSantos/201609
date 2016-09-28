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
	<?php
			$day = array("Saturday","Saturday","Sunday","Sunday","Monday","Monday","Tuesday","Tuesday","Wednesday","Wednesday","Thursday","Thursday","Friday","Friday");
			if(isset($_POST['st']))
			{
				// Loop to store and display values of individual checked checkbox.
				$s="select * from visiting_hours where d_id=\"$d_id\"";
				$result = $conn->query($s);
				$mail=array();
				$mail1=array();
				$ss=array();//all s_id
				$sss=array();//for storing s_id who have mail
				$s11=array();//for the time
				$i=0;
				$e=0;
				$e1=0;
				$q=0;
				if ($result->num_rows!=0) 
				{
					while($row = $result->fetch_assoc())
					{
						$ss[$q]=$row["s_id"];
						$s_t=$row["s_time"];
						$e_t=$row["e_time"];
						$s_s=$row["s_st"];
						$e_s=$row["e_st"];
						$q=$q+1;
						$r=0;
						if(!empty($_POST['visit']))
						{
							$cnt=count($_POST['visit']);
							for($i=0;$i<$cnt;$i++)
							{
								if($_POST['visit'][$i]==$row["s_id"])
								{
									$r=1;
									$t=$_POST['visit'][$i];
									$t=$t-1;
									if($s_t!=$_POST['start'][$t]||$e_t!=$_POST['end'][$t]||$s_s!=$_POST['ap'][$t]||$e_s!=$_POST['ap1'][$t])
									{
										$s="select * from appointment where v_id='".$row["v_id"]."'";
										$result1 = $conn->query($s);
										if ($result1->num_rows!=0) 
										{
											while($row1 = $result1->fetch_assoc())
											{
												$mail1[$e1]=$row1["email"];
												$e1=$e1+1;
											}
										}
									}
									$s="UPDATE visiting_hours SET s_time='".$_POST['start'][$t]."',s_st='".$_POST['ap'][$t]."',e_time='".$_POST['end'][$t]."',e_st='".$_POST['ap1'][$t]."',c_limit='".$_POST['limit'][$t]."' where s_id='".$_POST['visit'][$i]."'";
									$conn->query($s);
									break;
								}
							}
						}
						if($r==0)
						{
							$ttt=$row["s_id"];
							$t11=$row["s_time"]." ".$row["s_st"];
							$s="select * from appointment where v_id='".$row["v_id"]."'";
							$result1 = $conn->query($s);
							if ($result1->num_rows!=0) 
							{
								while($row1 = $result1->fetch_assoc())
								{
									$mail[$e]=$row1["email"];
									$sss[$e]=$ttt;
									$s11[$e]=$t11;
									$e=$e+1;
								}
							}
							$sql = "DELETE FROM visiting_hours WHERE d_id='$d_id' and s_id='".$row["s_id"]."'";
							mysqli_query($conn, $sql);
							$sql = "DELETE FROM appointment WHERE v_id='".$row["v_id"]."'";
							mysqli_query($conn, $sql);
						}
					}
				}
				if(!empty($_POST['visit']))
				{
					$cnt=count($_POST['visit']);
					for($i=0;$i<$cnt;$i++)
					{
						$r=0;
						for($j=0;$j<$q;$j++)
						{
							if($_POST['visit'][$i]==$ss[$j])
							{
								$r=1;
								break;
							}
						}
						if($r==0)
						{
							$tt=$_POST['visit'][$i];
							$t=$tt-1;
							$dd=$day[$t];
							$s="INSERT INTO visiting_hours (d_id,s_id,day,s_time,e_time,s_st,e_st,c_limit) VALUES('$d_id','$tt','$dd','".$_POST['start'][$t]."','".$_POST['end'][$t]."','".$_POST['ap'][$t]."','".$_POST['ap1'][$t]."','".$_POST['limit'][$t]."')";
							$conn->query($s);
						}
					}
				}
				$s="select name from doctors where email='".$_SESSION["email"]."'";
				$result = $conn->query($s);
				if ($result->num_rows!=0) 
				{
					if($row = $result->fetch_assoc())
					{ 
						$name=$row["name"];
					}
				}
				for($i=0;$i<$e;$i++)
				{
					$w=$sss[$i]-1;
					$real=0;
					if($w==0||$w==1)
						$real=0;
					else if($w==2||$w==3)
						$real=1;
					else if($w==4||$w==5)
						$real=2;
					else if($w==6||$w==7)
						$real=3;
					else if($w==8||$w==9)
						$real=4;
					else if($w==10||$w==11)
						$real=5;
					else if($w==12||$w==13)
						$real=6;
					$t=date('d-m-Y');
					$dw = strtolower(date("w",strtotime($t)));
					if($dw<6)
						$dw=$dw+1;
					else
						$dw=0;
					if($real>$dw)
					{
						$date=date("d/m/Y H:i:s");
						$mm=$name." will not be available at ".$day[$w]." ".$s11[$i]." this week.Please try another visiting hour.Sorry for the inconvenience.";
						$s="INSERT INTO notification (send,rec,message,date) VALUES('".$_SESSION["email"]."','".$mail[$i]."','$mm','$date')";
						$conn->query($s);
					}
				}
				for($i=0;$i<$e1;$i++)
				{
					$date=date("d/m/Y H:i:s");
					$mm=$name." schedule has been changed.Please see the appointment list for the perticular change.Sorry for the inconvenience.";
					$s="INSERT INTO notification (send,rec,message,date) VALUES('".$_SESSION["email"]."','".$mail1[$i]."','$mm','$date')";
					$conn->query($s);
				}
			}
			$s="select * from visiting_hours where d_id=\"$d_id\"";
			$result = $conn->query($s);
			$s_id=array();
			$s_time=array();
			$e_time=array();
			$s_st=array();
			$e_st=array();
			$c_limit=array();
			$booked=array();
			$i=0;
			if ($result->num_rows!=0) 
			{
				while($row = $result->fetch_assoc())
				{
					$s_id[$i]=$row["s_id"];
					$s_time[$i]=$row["s_time"];
					$e_time[$i]=$row["e_time"];
					$c_limit[$i]=$row["c_limit"];
					$s_st[$i]=$row["s_st"];
					$e_st[$i]=$row["e_st"];
					$s="select * from appointment where v_id='".$row["v_id"]."'";
					$result1 = $conn->query($s);
					$cnt=0;
					if ($result1->num_rows!=0) 
					{
						while($row1 = $result1->fetch_assoc())
						{
							$cnt=$cnt+1;
						}
					}
					$booked[$i]=$cnt;
					$i=$i+1;
				}
			}
		?>
		<div class="container">	

			<section class="shopping-cart">
			<br><br><br>
			<h2 class="title">Visiting Hours</h2>
			<br><br><br>
			<form action="dpanel.php" role="form"  method="post" enctype="multipart/form-data">
			<table class="items-list" id="tblDisplay">
			<tr id="chkrow">
			
				<th style="padding-bottom:20px; ">Doctor Name</th>
			  <th style="padding-bottom:20px;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Day</th>
			  <th style="padding-bottom:20px;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Starting Time</th>
			  <th style="padding-bottom:20px;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ending Time</th>
			  <th style="padding-bottom:20px;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limit</th>
			  <th style="padding-bottom:20px;font-size:20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Booked</th>
			</tr>
				<tbody>
					<!--Item-->
					<?php
					$k=1;
					while($k<=14)
					{
					?>
					<tr class="item">
					  <?php
						$j=0;
						$t=0;
						while($j<$i)
						{
							if($s_id[$j]==$k)
							{
								$t=1;
					  ?>
					  <td style="width:100px;">
							<input type="checkbox" name="visit[]" value=<?php echo $k;?> checked>
						</td>
					  <td style="width:150px;text-align:center;"><?php echo $day[$k-1];?></td>
					  <td class="qnt-count" style="width:100px;text-align:center;font-size:15px;">
						<input type="text" id="start" name="start[]" value=<?php echo $s_time[$j];?> class="form-control" style="height:33px;width:45px;">
						<select class="dropdown" style="height:30px" name="ap[]" id="ap">
							<?php
								if($s_st[$j]=="AM")
								{
							?>
							<option value="AM" selected>AM</option>
							<option value="PM">PM</option>
							<?php
								}
								else
								{
							?>
									<option value="AM">AM</option>
									<option value="PM"selected>PM</option>
							<?php
								}
								?>
						</select> 
					  </td>
					  <td class="qnt-count" style="width:100px;text-align:center; font-size:15px;">
						<input type="text" id="end" name="end[]" value=<?php echo $e_time[$j];?> class="form-control" style="height:33px;width:45px;" >
						<select class="dropdown" style="height:30px;" name="ap1[]" id="ap1">
							<?php
								if($e_st[$j]=="AM")
								{
							?>
							<option value="AM" selected>AM</option>
							<option value="PM">PM</option>
							<?php
								}
								else
								{
							?>
									<option value="AM">AM</option>
									<option value="PM"selected>PM</option>
							<?php
								}
								?>
						</select> 
					  </td>
					  <td class="qnt-count" style="width:100px;text-align:center;">
							<input type="text" id="limit" name="limit[]" value=<?php echo $c_limit[$j];?> class="form-control" style="height:33px;width:45px;">
					  </td>
					  <td style="width:100px;text-align:center;"><?php echo $booked[$j]?>/<?php echo $c_limit[$j];?></td>
					  <?php
							}
							$j=$j+1;
						}
						if($t==0)
						{
					  ?>
						<td style="width:100px;">
							<input type="checkbox" name="visit[]" value=<?php echo $k;?> />
						</td>
						<td style="width:150px;text-align:center;"><?php echo $day[$k-1];?></td>
						<td class="qnt-count" style="width:100px;text-align:center;font-size:15px;">
						<input type="text" id="start" name="start[]" value="00:00" class="form-control" style="height:33px;width:45px;">
						<select class="dropdown" style="height:30px" name="ap[]" id="ap">
							<option value="AM" selected>AM</option>
							<option value="PM">PM</option>
						</select> 
					  </td>
					  <td class="qnt-count" style="width:100px;text-align:center; font-size:15px;">
						<input type="text" id="end" name="end[]" value="00:00" class="form-control" style="height:33px;width:45px;" />
						<select class="dropdown" style="height:30px;" name="ap1[]" id="ap1">
							<option value="AM" selected>AM</option>
							<option value="PM">PM</option>
						</select> 
					  </td>
					  <td class="qnt-count" style="width:100px;text-align:center;">
							<input type="text" id="limit" name="limit[]" value="0" class="form-control" style="height:33px;width:45px;">
					  </td>
					  <td style="width:100px;text-align:center;">0/0</td>
					  <?php
						}
					  ?>
					</tr>
					<?php
						$k=$k+1;
					}
					?>
					
						</tbody></table>
						
						</form>
            <br><br>
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