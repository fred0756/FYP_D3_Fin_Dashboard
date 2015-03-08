<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- SideBar CSS -->
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
	
	<!-- Dropdown CSS -->
    <link href="../assets/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Page</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href='<?php echo base_url()."main/logout"?>'><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a class="active" href="index.php"><i class="fa fa-wrench fa-fw"></i> List All User</a>
                        </li>
						
						<li>
                            <a href="index.php"><i class="fa fa-search"></i>Search User</a>
                        </li>
						<li>
                            <a href="index.php"><i class="fa fa-plus"></i>Add User</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
		
		
        <div id="page-wrapper">
		<div class="panel panel-default">
                        <div class="panel-heading">
                            User Administration
                        </div>
                        <div class="panel-body">
						Manage account profile here

                    </div>
			<div class="table-responsive">
				<table class="table table-bordered" id="user_table">
					<thead>
						<tr>
							<th>#</th>
							<th>email</th>
							<th>Profile</th>
							<th>Change To</th>
							<th>Make Change</th>

						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach($user as $value){
								print("<tr>\n");
								print("<td>$i</td>\n");
								print("<td>".$value['email']."</td>\n");
								print("<td>".$value['profile']."</td>\n");
								print("<td>\n<select class=\"selectpicker\">\n<option>admin</option>\n<option>manager</option>\n<option>user</option>\n</select>\n</td>\n");
								print("<td><button type=\"button\" class=\"btn btn-default\" onclick=\"changeprofile(".$i.")\">Confirm</button></td>\n</tr>");
								$i++;
							}
						?>
					</tbody>
				</table>
			</div>
			                        </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>
	
	<!-- Custom Dropdown JavaScript -->
    <script src="../assets/js/bootstrap-select.min.js"></script>
	
	<script>
		function changeprofile(row){
			var email = $("#user_table  tr:eq("+row+") td:nth-child(2)").text();
			var profile=$("#user_table  tr:eq("+row+") td:nth-child(4) option:selected").text();
			$.post('http://101.78.175.101:7280/fyp/ci_fyp/admin/update_profile/'+email+'/'+profile,function(){
				window.location.href = window.location.href;
			});
		}
	</script>

</body>

</html>
