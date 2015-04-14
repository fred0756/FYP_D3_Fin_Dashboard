<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ECM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="<?php echo base_url();?>/assets/css/sticky-footer-navbar.css" rel="stylesheet">
	<link href="<?php echo base_url();?>/assets/css/priceplan.css" rel="stylesheet">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <style type="text/css">
		/*{
			background: url('http://farm3.staticflickr.com/2832/12303719364_c25cecdc28_b.jpg') fixed;*/
		/* CSS used here will be applied after bootstrap.css */

		body { 
			background: url('<?php echo base_url();?>/assets/images/background.jpg') fixed;
			background-size: cover;
			padding: 0;
			margin: 0;
		}


		.panel-default {
		 opacity: 0.9;
		 margin-top:30px;

		}
		.form-group.last {
		 margin-bottom:0px;
		}

    </style>
    <script src="<?php echo base_url();?>/assets/js/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading"> <strong class="">Login</strong>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="<?php echo base_url()."main/login_validation"?>" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input name= "email" class="form-control" id="inputEmail3" placeholder="Email" required="" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input name= "password" class="form-control" id="inputPassword3" placeholder="Password" required="" type="password">
                                </div>
                            </div>

                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="submit" class="btn btn-success btn-sm">Sign in</button>
                                    <button type="reset" class="btn btn-default btn-sm">Reset</button>
                                    <span><br/><?php echo validation_errors(); ?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-footer">Not Registered? 
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#registerModal">
                            Register Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<footer class="footer-distributed">

			<div class="footer-left">

				<h3>ECM<span> DSS</span></h3>

				<p class="footer-links">
					<a href="http://101.78.175.101:7280/fyp/ci_fyp/">Home</a>
					·
					<a href="#" data-toggle="modal" data-target="#priceModal">Pricing</a>
					·
					<a href="#"data-toggle="modal" data-target="#aboutModal">About</a>


				</p>

				<p class="footer-company-name">Fred WANG &copy; 2015</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p><span>Computer Science,HKBU</span> KLN, Hong Kong</p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+852 64844283</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="mailto:fred.zi.wang@gmail.com">fred.zi.wang@gmail.com</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About our company</span>
					We are a professional service providing company specialized in Stock Market Data Decision Support.
				</p>

				<div class="footer-icons">
					<a href="https://www.linkedin.com/profile/public-profile-settings?trk=prof-edit-edit-public_profile"><i class="fa fa-linkedin"></i></a>
					<a href="https://github.com/fred0756"><i class="fa fa-github"></i></a>
					<a href="https://www.facebook.com/profile.php?id=100001541173848"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-weibo"></i></a>
					

				</div>

			</div>

		</footer>



<div class="modal fade" id="registerModal" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="register_form" action="<?php echo base_url()."main/signup_validation"?>"  method="POST">
                        <fieldset>
                        <div class="control-group">
                        <!-- E-mail -->
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <input type="text" id="email" name="email" placeholder="" class="input-xlarge" type="email">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
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
						<div class="control-group">
                        <!-- Name -->
                            <label class="control-label" for="text">Name(Optional)</label>
                            <div class="controls">
                                <input type="text" id="name" name="name" placeholder="" class="input-xlarge" type="text">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Phone -->
                            <label class="control-label" for="text">Phone(Optional)</label>
                            <div class="controls">
                                <input type="text" id="phone" name="phone" placeholder="" class="input-xlarge" type="text">
                                <p class="help-block" id ="email_msg"></p>
                            </div>
                        </div>
						<div class="control-group">
                        <!-- Address -->
                            <label class="control-label" for="text">Address(Optional)</label>
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
                <button type="submit" form="register_form" name="submit" class="btn btn-success">Register</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="priceModal" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
				<div class="container">
					<div class="column">
					
					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-white">
						<div class="panel-heading  text-center">
						<h3>BASE PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>$9.99 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-danger"></i> Personal use</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i>1 Portfolio</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i> 10 Selected Stocks</li>
						</ul>
						<div class="panel-footer">
						<center>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----MIIHfwYJKoZIhvcNAQcEoIIHcDCCB2wCAQExggEwMIIBLAIBADCBlDCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20CAQAwDQYJKoZIhvcNAQEBBQAEgYBAzN6kLlFIZpAr342MnTRYdEVYyhF/q6i29BfF9RbYLT6Kg2tmX5BxTZMi/5ANo8HQYGWLRJ6RuW2lKgONrJKZwXERGg05RcDbwZSpYqk00I5+QpD5WTsBPIbhUj4UctndINZWSJW1HAsJz1owtjllUwBYrDq4LbdYbKuZU/ebNDELMAkGBSsOAwIaBQAwgfwGCSqGSIb3DQEHATAUBggqhkiG9w0DBwQIsZog7qyVA36AgdhRc4J42TMSxSbSBzumcD7BsXXutHXNPBsE8aoQu8NWcIMWK1Ao0tlhbBb/HQTOCQH9LwKU430na2GbM+aLzgWA29hAjtOgFFfjEl6uh5OLqQOp3qvytznBw/tIL7/yOVkserdRbEz4dfpnWaVjkjeS/mfsm3IEUgUUjSSAtiroP4wSguAeVAwqgDsezRpa1KHyG3usdPeFH6Hu1a6iIYXrUKVX54+R+lPNQj7xzDHw2cp96lWHtqutyy6uG5OQpaelkxJLQC40ENjtWR21AVZEpndj4iR47WGgggOHMIIDgzCCAuygAwIBAgIBADANBgkqhkiG9w0BAQUFADCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wHhcNMDQwMjEzMTAxMzE1WhcNMzUwMjEzMTAxMzE1WjCBjjELMAkGA1UEBhMCVVMxCzAJBgNVBAgTAkNBMRYwFAYDVQQHEw1Nb3VudGFpbiBWaWV3MRQwEgYDVQQKEwtQYXlQYWwgSW5jLjETMBEGA1UECxQKbGl2ZV9jZXJ0czERMA8GA1UEAxQIbGl2ZV9hcGkxHDAaBgkqhkiG9w0BCQEWDXJlQHBheXBhbC5jb20wgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMFHTt38RMxLXJyO2SmS+Ndl72T7oKJ4u4uw+6awntALWh03PewmIJuzbALScsTS4sZoS1fKciBGoh11gIfHzylvkdNe/hJl66/RGqrj5rFb08sAABNTzDTiqqNpJeBsYs/c2aiGozptX2RlnBktH+SUNpAajW724Nv2Wvhif6sFAgMBAAGjge4wgeswHQYDVR0OBBYEFJaffLvGbxe9WT9S1wob7BDWZJRrMIG7BgNVHSMEgbMwgbCAFJaffLvGbxe9WT9S1wob7BDWZJRroYGUpIGRMIGOMQswCQYDVQQGEwJVUzELMAkGA1UECBMCQ0ExFjAUBgNVBAcTDU1vdW50YWluIFZpZXcxFDASBgNVBAoTC1BheVBhbCBJbmMuMRMwEQYDVQQLFApsaXZlX2NlcnRzMREwDwYDVQQDFAhsaXZlX2FwaTEcMBoGCSqGSIb3DQEJARYNcmVAcGF5cGFsLmNvbYIBADAMBgNVHRMEBTADAQH/MA0GCSqGSIb3DQEBBQUAA4GBAIFfOlaagFrl71+jq6OKidbWFSE+Q4FqROvdgIONth+8kSK//Y/4ihuE4Ymvzn5ceE3S/iBSQQMjyvb+s2TWbQYDwcp129OPIbD9epdr4tJOUNiSojw7BHwYRiPh58S1xGlFgHFXwrEBb3dgNbMUa+u4qectsMAXpVHnD9wIyfmHMYIBmjCCAZYCAQEwgZQwgY4xCzAJBgNVBAYTAlVTMQswCQYDVQQIEwJDQTEWMBQGA1UEBxMNTW91bnRhaW4gVmlldzEUMBIGA1UEChMLUGF5UGFsIEluYy4xEzARBgNVBAsUCmxpdmVfY2VydHMxETAPBgNVBAMUCGxpdmVfYXBpMRwwGgYJKoZIhvcNAQkBFg1yZUBwYXlwYWwuY29tAgEAMAkGBSsOAwIaBQCgXTAYBgkqhkiG9w0BCQMxCwYJKoZIhvcNAQcBMBwGCSqGSIb3DQEJBTEPFw0xNTAzMDcxMDEwMThaMCMGCSqGSIb3DQEJBDEWBBRmnkWV3/QAf7UI0H1NcNLXtV6VpjANBgkqhkiG9w0BAQEFAASBgIhAtfbH+aw2BO+USA8O66xUleRVEa6uKHe23+VWyFN72K1CyN4E12QorOhJddsT8+HWsRyisbwRMA4iQ33MAxKS9uWnPZqu/DHIeqDlMnIIEY+eSQnfwTDu2JTNsSq02tYhm+i9D+dZ0y6Zj4emJwvTUav8+XlKMRiQtMCFifPL-----END PKCS7-----
									">
								<input type="image" src="https://www.paypalobjects.com/en_GB/HK/i/btn/btn_buynowCC_LG_wCUP.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
								<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
							</form>
						</center>
						</div>
					</div>
					
					<!-- /PRICE ITEM -->
					</div>
					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-blue">
						<div class="panel-heading arrow_box text-center">
						<h3>STANDARD PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>$19.99 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-info"></i> Business use</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> Up to 5 Portfolios</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> Unlimited Stocks</li>
						</ul>
						<div class="panel-footer">
						<center>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_GB/HK/i/btn/btn_buynowCC_LG_wCUP.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

						</center>
						</div>
					</div>
					
					<!-- /PRICE ITEM -->
					</div>
					<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-red">
						<div class="panel-heading arrow_box text-center">
						<h3>PRO PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>$29.99 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-info"></i> Business use</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> Unlimited Portfolio</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> Unlimited Stocks</li>
						</ul>
						<div class="panel-footer">
							<center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypalobjects.com/en_GB/HK/i/btn/btn_buynowCC_LG_wCUP.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>


							</center>
						</div>
					</div>
					
					<!-- /PRICE ITEM -->
					</div>
					</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" id="aboutModal" role="dialog" data-backdrop="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
			    <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">About</h4>
                </div>
                <div class="modal-body">
				<h3>Admin Function</h3>
				<img src="<?php echo base_url();?>/assets/images/about/admin.jpg" alt="HTML5 Icon" style="width:800px">
				<h3>Listed companies</h3>
				<img src="<?php echo base_url();?>/assets/images/about/manager1.jpg" alt="HTML5 Icon" style="width:800px">
				<h3>Portfolio Management</h3>
				<img src="<?php echo base_url();?>/assets/images/about/manager2.jpg" alt="HTML5 Icon" style="width:800px">
				<img src="<?php echo base_url();?>/assets/images/about/dashboard.jpg" alt="HTML5 Icon" style="width:800px">
				<h3>Technical Analysis Charts </h3>
				<img src="<?php echo base_url();?>/assets/images/about/candlestick.jpg" alt="HTML5 Icon" style="width:800px">
				<h3></h3>
				<img src="<?php echo base_url();?>/assets/images/about/volume.jpg" alt="HTML5 Icon" style="width:800px">
				<h3></h3>
				<img src="<?php echo base_url();?>/assets/images/about/macd.jpg" alt="HTML5 Icon" style="width:800px">
				<h3></h3>
					<img src="<?php echo base_url();?>/assets/images/about/rsi.jpg" alt="HTML5 Icon" style="width:800px">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
		</div>
    </div>
</div>



<script>


$(document).ready(function(){
	var email = $("#email");
	var password= $("#password");
	var password_confirm= $("#password_confirm");
	
	email.change(function(){
		if(!validateEmail(email.val())){
			$("#email_msg").html("Invalid Email Address");
		}
		else $("#email_msg").html("");
	})
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

	
	function validateEmail(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
	
});



</script>

</body>
</html>
