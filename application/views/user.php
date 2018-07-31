<div class="container">
    <div class="row">
        <section class="col-md-8 col-md-offset-0 g-module">
        
	<form class="form" method="post" action="/user/manage">
                <input type="username" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" autofocus>
                <input type="password" name="pass1" class="form-control" placeholder="Password">
                <input type="password" name="pass2" class="form-control" placeholder="Repeat Password">
                <input type="email" name="email" class="form-control" value="<?php if (!empty($email)) echo $email; ?>" placeholder="Email">

                <button class="btn btn-default" value="update" type="submit">Update Information</button>
                <h5><?php echo validation_errors(); ?>
                    <?php if ($auth!=1): ?>
			<?php echo $auth; ?>
                    <?php endif; ?>

                </h5>
            </form>

		</section>
    </div>
</div> <!-- /container -->
