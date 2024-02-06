<?php
/*
Template Name: Login Template
*/

get_header();
?>

<section>
	<div class="container padding-bottom-lg padding-top-lg margin-top-lg margin-bottom-lg">
		<div class="row padding-bottom-lg padding-top-lg">
			<div class="col-lg-4 col-lg-push-4 col-md-4 col-md-push-4 col-sm-6 col-sm-push-3 col-xs-10 col-xs-push-1 col-xx-10 col-xx-push-1 thumbBoxShadow2">
				<div class="">
                	<div class="dispBlock">
                    	<img src="https://realitylabsacademy-fb-com-preprod.go-vip.net/wp-content/uploads/2021/12/meta-reality-labs-academy-logo.png" alt="" class="img90 margin-bottom-lg margin-top"/>
						<h2 class="txtGrey text-center fontXtraLight margin-bottom margin-top">LOGIN</h2>
					</div>
                    <div class="dispBlock">
                    	<div class="errormsg" id="empty" > Please Enter Password </div>
                        <div class="errormsg" id="fail" > Invalid Credentials </div>
                        <!--<div class="errormsg" id="success" > Please Enter Password </div>-->
						<form class="form" name="login" id="login" method="post">
							<div class="form-group form-group-label">
								<div class="row">
									<div class="col-md-10 col-md-push-1 margin-bottom margin-top-no">
										<label class="floating-label fontTxt font18" for="pass">Enter Password to Login</label>
										<input class="form-control fontTxt font18" name="usrpwd" id="usrpwd" type="password" required="required" >
									</div>
								</div>
							</div>
                            <div class="form-group">
								<div class="row">
									<div class="col-md-10 col-md-push-1 text-right">
										<button class="btn btnBlue waves-attach waves-light padding-left padding-right font16 fontTxt" id="logsubmit">SUBMIT</button>
                                         
									</div>
								</div>
							</div>  
						</form>
					</div>
				</div>
			</div>
		</div>
	
    </div><!--container-->
</section>
<?php
get_footer();
