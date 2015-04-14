<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manager Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../assets/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
	<!-- Datatable Bootstrap CSS -->
	<link href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css" type="text/css" rel="stylesheet" ></link>

	  <!-- Datatable CSS -->
	<link href="../assets/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" ></link>
	
	<style>
	td {
		width:auto;
	}
	</style>

	

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
                <a class="navbar-brand" href="index.html">Manager Page</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" onclick="showuserProfileModal()"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#" onclick="showChangePassModal()"><i class="fa fa-gear fa-fw"></i> Change Password</a>
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

                        <li class="active">
                            <a href="#"><i class="fa fa-suitcase"></i> portfolio Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a  class="active" href="main_content">CheckStocklist</a>
                                </li>
                                <li>
                                    <a href="#add_portfolio" data-toggle="modal">Add portfolio</a>
                                </li>
								<li>
                                    <a  href="load_modify_portfolio">Portfolio Details</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                        <div class="panel-body">
                            <h3>Listed Companies</h3>
                            <p>Below are the listed companies in AMEX, NASDAQ and NYSE. Please add them to your portfolio by adding the symbol.</p>
						</div>
				</div>
			</div>
			<table class="table table-striped table-bordered" cellspacing="0" id="stock_list">
				<thead>
					<tr>
						<th>id</th>
						<th>Symbol</th>
						<th>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
						<th>Exchange</th>
						<th>Sector</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot></tfoot>
			</table>
			
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	
	<div class ="modal fade" id="add_portfolio" role="dialog">
		<div class ="modal-dialog">
			<div class ="modal-content">
				<div class = "modal-header">
					<h4>portfolio Information</h4>
				</div>
				<div class = "modal-body">
                    <form class="form-horizontal" id="portfolio_form" action="<?php echo base_url()."main/add_portfolio"?>"  method="POST">
                        <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="text">manager</label>
                            <div class="controls">
								<input type="text" placeholder="" name="manager" value= "<?php echo $this->session->userdata('email')?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="control-group">
							<label class="control-label" for="text" >portfolio Name</label>
							<div class="controls">
								<input type="text" placeholder="" name="name" id="name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"  for="description">Description</label>
                            <div class="controls">
								<textarea rows="3" name="description" id="description"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </form>
				</div>
				<div class = "modal-footer">
					<button class ="btn btn-default" data-dismiss = "modal">close</button>
					<button class ="btn btn-primary" type="submit" form="portfolio_form" name="submit" >Add</button>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="modal fade" id="userProfileModal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">User profile Setting</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="edit_profile_form" action="<?php echo base_url()."ajax/edit_user_profile"?>"  method="POST">
                        <fieldset>
                        <div class="control-group">
                        <!-- E-mail -->
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <input type="text" id="email" name="email" placeholder="" class="input-xlarge" type="email"  readonly="readonly">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Name -->
                            <label class="control-label" for="text">Profile</label>
                            <div class="controls">
                                <input type="text" id="profile" name="profile" placeholder="" class="input-xlarge" type="text"  readonly="readonly">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Name -->
                            <label class="control-label" for="text">Name</label>
                            <div class="controls">
                                <input type="text" id="username" name="username" placeholder="" class="input-xlarge" type="text">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Phone -->
                            <label class="control-label" for="text">Phone</label>
                            <div class="controls">
                                <input type="text" id="phone" name="phone" placeholder="" class="input-xlarge" type="text">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Address -->
                            <label class="control-label" for="text">Address</label>
                            <div class="controls">
                                <input type="text" id="address" name="address" placeholder="" class="input-xlarge" type="text">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="edit_profile_form" name="submit" class="btn btn-success">Sumbit Changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="passwordModal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="pass_form" action="<?php echo base_url()."ajax/edit_user_password"?>"  method="POST">
                        <fieldset>
                        <div class="control-group">
                        <!-- Password-->
                            <label class="control-label" for="password">Password</label>
                            <div class="controls">
                                <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                                <p class="help-block" id ="password_msg"></p>
                            </div>
                        </div>

                        <div class="control-group">
                        <!-- Password -->
                            <label class="control-label"  for="password_confirm">Password (Confirm)</label>
                            <div class="controls">
                                <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
                                <p class="help-block" id="password_confirm_msg"></p>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="pass_form" name="submit" class="btn btn-success">Change Password</button>
            </div>
        </div>
    </div>
</div>
	
	

    <!-- jQuery -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>
	
	<!--DataTable JavaScript -->
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/jquery.dataTables.delay.min.js"></script>
	<script src="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	
	<script>
$(document).ready(function() {
		$('#stock_list').dataTable({
        "processing": true,
        "serverSide": true,
		"autoWidth": false,
		"sAjaxSource": '<?php echo base_url(); ?>main/get_stock_list',
		"sAjaxDataProp": "data",
		"sPaginationType": "full_numbers",
		"sServerMethod": "POST",
		"aoColumns": [
			{ "mDataProp": "id" },
			{ "mDataProp": "symbol" },
			{ "mDataProp": "name" },
			{ "mDataProp": "exchange" },
			{ "mDataProp": "sector" }
		],

    });
	
	var password= $("#password");
	var password_confirm= $("#password_confirm");
		password.change(function(){
		if(password.val().length<4){
		$("#password_msg").html("Password should be at least 4 characters");
		}
		else $("#password_msg").html("");
	})
	password_confirm.change(function(){
		if(password.val()!=password_confirm.val()){
			$("#password_confirm_msg").html("Your password is not consistent");
		}
		else $("#password_confirm_msg").html("");
	})
	
	
});


	function showuserProfileModal(){
		$.post(
			'<?php echo base_url(); ?>ajax/get_user_profile/',
				function(data){
				
					data= $.parseJSON(data);
					email= data[0].email;
					profile= data[0].profile;
					name=data[0].name;
					phone=data[0].phone;
					address=data[0].address;
					console.log(data[0].name);
					$('#email').val(email);
					$('#profile').val(profile);
					$('#address').val(address);
					$('#phone').val(phone);
					$('#username').val(name);
				//	console.log(data);
				//	console.log(data[0].id);
					$('#userProfileModal').modal('show');
				}
		);
		
	}
	
	function showChangePassModal(){
		$('#passwordModal').modal('show');
	}
</script>

</body>

</html>