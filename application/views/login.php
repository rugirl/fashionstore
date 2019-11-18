<!DOCTYPE html>
<html lang="en">
<head>
	<title>Fashion Store User Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container py-5">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-center text-white mb-4">Fashion Store User Login</h2>
			<?php
			if($this->session->flashdata('message'))
			{
				echo '
      <div class="alert alert-success">
          '.$this->session->flashdata("message").'
      </div>
      ';
			}
			?>

			<div class="row">
				<div class="col-md-6 mx-auto">
					<!-- form card login -->
					<div class="card rounded-0">
						<div class="card-header">
							<h3 class="mb-0">Login</h3>
						</div>
						<div class="card-body">
							<?php
							$attributes = array('id' => 'formLogin', 'class' => 'form', 'role' => 'form', 'method' => 'post');
							echo form_open('admin/login', $attributes);
							?>
							<div class="form-group">
								<?php echo form_label('Username*', 'username'); ?>
								<?php
								$form_data = array('name' => 'username', 'id' => 'username',
									'class' => 'form-control form-control-lg rounded-0', 'required' => '');
								echo form_input($form_data); ?>
								<div class="invalid-feedback">Please insert the username.</div>
							</div>
							<div class="form-group">
								<?php echo form_label('Password*', 'password'); ?>
								<?php
								$form_data = array('type' => 'password', 'name' => 'password', 'id' => 'password',
									'class' => 'form-control form-control-lg rounded-0', 'required' => '');
								echo form_input($form_data); ?>
								<div class="invalid-feedback">Please insert the password.</div>
							</div>
							<div class="form-group">
								<div class="col-sm-9 col-sm-offset-3">
									<span class="help-block">*Required fields</span>
								</div>
							</div>
							<button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login
							</button>
							<?php form_close(); ?><!-- /form -->
						</div>
						<!--/card-block-->
					</div>
					<!-- /form card login -->
				</div>
			</div>
			<!--/row-->
		</div>
		<!--/col-->
	</div>
	<!--/row-->
</div>
<!--/container-->
<script>
    $("#btnLogin").click(function (event) {
//custom validation
        var form = $("#formLogin")

        if (form[0].checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
        }
        form.addClass('was-validated');
    });
</script>
</body>

</html>
