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

	
	 <!-- Datepicker CSS -->
	<link href="../assets/css/datepicker.css" type="text/css" rel="stylesheet" ></link>
	
	<style>
	td {
		width:auto;
	}
	.modal-dialog{
		width:700px
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
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Change Password</a>
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
                                    <a  href="main_content">CheckStocklist</a>
                                </li>
                                <li>
                                    <a href="#add_portfolio" data-toggle="modal">Add portfolio</a>
                                </li>
								<li>
                                    <a class="active" href="load_modify_portfolio">Portfolio Details</a>
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
                            <h3>Portfolio Detail</h3>
                            <p>Review Performance dashboard or manage your portfolio here.</p>
						</div>
				</div>
			</div>
						<div class="table-responsive">
				<table class="table table-bordered" id="portfolio_table">
					<thead>
						<tr>
							<th>#</th>
							<th>name</th>
							<th>manager</th>
							<th>description</th>
							<th>Dashboard</th>
							<th>Modify</th>

						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							foreach($list as $value){
								print("<tr>\n");
								print("<td>".$value['id']."</td>\n");
								print("<td>".$value['name']."</td>\n");
								print("<td>".$value['manager']."</td>\n");
								print("<td>".$value['description']."</td>\n");
								print("<td><i type=\"button\" class=\"fa fa-tachometer fa-2x\" onclick=\"openDashboard(".$i.")\"></i></td>");
								print("<td><i type=\"button\" class=\"fa fa-pencil-square-o fa-2x\" onclick=\"showmodal(".$i.")\"></i></td>\n</tr>");
								$i++;
							}
						?>
					</tbody>
				</table>
			</div>
			
					
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
								<input type="text" placeholder="" name="manager" id="manager" value= "<?php echo $this->session->userdata('email')?>" readonly="readonly">
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
	
	
	
	<div class ="modal fade" id="modify_stock" role="dialog">
		<div class ="modal-dialog">
			<div class ="modal-content">
				<div class = "modal-header">
					<h4>portfolio Information</h4>
				</div>
				<div class = "modal-body">
                    <form class="form-horizontal" id="modify_stock_form" name="modify_stock_form">
                        <fieldset>
						<div class="control-group">
                            <label class="control-label" for="text">ID</label>
                            <div class="controls">
								<input type="text" placeholder="" name="read_only_id" id="read_only_id" readonly="readonly" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="text">manager</label>
                            <div class="controls">
								<input type="text" placeholder="" name="editable_manager" readonly="readonly" id="editable_manager" value="">
                            </div>
                        </div>
                        <div class="control-group">
							<label class="control-label" for="text" >portfolio Name</label>
							<div class="controls">
								<input type="text" placeholder="" name="editable_name" id="editable_name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"  for="description">Description</label>
                            <div class="controls">
								<textarea rows="3" name="editable_description" id="editable_description"></textarea>
                            </div>
                        </div>
                    </fieldset>
               
					<hr>
					<h4>Modify Stock</h4>
					
					<fieldset>
					<table class="table table-no-border" id="symbol_quantity">
					<thead>
						<tr>
							<th>Symbol</th>
							<th>Quantity</th>
							<th>Settle Date</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
				</fieldset>
				 </form>
				
				</div>
				<div class = "modal-footer">
					<button class ="btn btn-default" data-dismiss = "modal">close</button>
					<button class ="btn btn-primary" id="sumbitchange">Submit</button>
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
	<!--datepicker js-->
	 <script src="../assets/js/bootstrap-datepicker.js"></script>
	 
	<!--typeahead js-->
	 <script src="../assets/js/bootstrap3-typeahead.js"></script>
	 
	 
	<script>
				var symbols= [];	
	
		function openDashboard(row){
			var id = $("#portfolio_table  tr:eq("+row+") td:nth-child(1)").text();

			var win = window.open('<?php echo base_url(); ?>main/dashboard/'+id, '_blank');
			win.focus();
		}
	
		function showmodal(row){
			console.log("1");
			var id = $("#portfolio_table  tr:eq("+row+") td:nth-child(1)").text();
			var name = $("#portfolio_table  tr:eq("+row+") td:nth-child(2)").text();
			var manager = $("#portfolio_table  tr:eq("+row+") td:nth-child(3)").text();
			var description = $("#portfolio_table  tr:eq("+row+") td:nth-child(4)").text();
			var profile=$("#portfolio_table  tr:eq("+row+") td:nth-child(4) option:selected").text();
			$('#symbol_quantity > tbody').empty();

			$.ajax({
				async: false,
				type : "POST",
				url : '<?php echo base_url(); ?>ajax/get_symbol',
				dataType : 'json',
				success : function(data) {
					for (var i = 0; i < data.length; i++) {
						symbols.push(data[i].symbol);
					}
				}
			});

			console.log(symbols);
			$.post(
				'<?php echo base_url(); ?>ajax/get_portfolio/'+id,
				function(data){
					console.log("2");
					$('#read_only_id').val(id);
					$('#editable_manager').val(manager);
					$('#editable_name').val(name);
					$('#editable_description').val(description);
					data= $.parseJSON(data);
					console.log("3");
					$.each( data, function(index, content){ 
						$('#symbol_quantity > tbody:last')
						.append(
						'<tr>'
						+'<td><input type="text"  class= "symbolautocomplete" name="symbol" value="'+content['symbol']+'"></td>'
						+'<td><input type="text"  name="quantity"  value="'+content['quantity']+'"></td>'
						+'<td><input type="text" name="date" class="datepicker" value ="'+content['settle_date']+'"></td>'
						+'<td><div onclick=" $(this).parent().parent().remove();" style="border:0px solid black; background-color: transparent;"><i class="fa fa-minus"></i></div></td>'
						+'</tr>');
					}); 
					$('.datepicker').datepicker({
						format: "yyyy-mm-dd",
						todayBtn: "linked",
						clearBtn: true,
						daysOfWeekDisabled: "0,6",
						autoclose: true
					});
					$('.symbolautocomplete').typeahead({
						source:symbols
					});
				console.log("4");
				$('#symbol_quantity > tbody:last').append('<tr><td></td><td></td><td></td><td><div onclick="addrow()" style="border:0px solid black; background-color: transparent;"><i class="fa fa-plus"></i></div></td></tr>');
				$('#modify_stock').modal('show');
			});
		}
		function addrow(){
			$('#symbol_quantity > tbody:last>tr:last').before(
			'<tr>'
			+'<td><input type="text" class= "symbolautocomplete" name="symbol"></td>'
			+'<td><input type="text" name="quantity" ></td>'
			+'<td><input type="text" name="date" class="datepicker"></td>'
			+'<td><div onclick=" $(this).parent().parent().remove();" style=" border:0px solid black; background-color: transparent;"><i class="fa fa-minus"></i></div></td>'
			+'</tr>');
			$('.datepicker').datepicker({
					format: "yyyy-mm-dd",
					todayBtn: "linked",
					clearBtn: true,
					daysOfWeekDisabled: "0,6",
					autoclose: true
			});
			$('.symbolautocomplete').typeahead({
				source:symbols
			});
		}
		
		function deleterow(){
			$(this).father.remove();
			}
			
		$(document).ready(function(){
			$('#sumbitchange').click(function(){
				var result = {};
				var single_row =new Array;
				result['id']=$('#read_only_id').val();
				result['manager']=$('#editable_manager').val();
				result['name']=$('#editable_name').val();
				result['description']=$('#editable_description').val();
				result['symbol_quantity'] =  [[]]; ;
				$('#symbol_quantity tbody tr').each(function(index1){ 
				   $(this).closest('tr').find("input").each(function(index2) {
						single_row[index2]=this.value;
					});
					result['symbol_quantity'][index1]=single_row;
					single_row =new Array;
				})
				result['symbol_quantity'].pop();
				console.log(result);
				$.ajax({
					type: 'POST',
					url: '<?php echo base_url(); ?>ajax/store_portfolio/',
					data:   {result:result},
					success: function(){ 
						console.log("success");
						window.location.href = window.location.href;
					}
				});
			})
		})
			
	</script>

</body>

</html>