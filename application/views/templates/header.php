<?php
if ($this->session->userdata('logged_in')){
    $current_user_id = $this->session->userdata('id');
	$user = $this->db_model->getUserName($this->session->userdata('id'));
	$logged_in = 1;
} else {
	$logged_in = -1;
}
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/images/favicon.ico" />
	
    <title><?php echo $title; ?></title>
    <link href="/assets/css/main.css" rel="stylesheet" media="screen">

    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,300' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel='stylesheet' type='text/css'>
    <!-- Bootstrap core CSS -->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script>
        var logged_in = <?php echo $logged_in; ?>;
    </script>



 </head>

    <body>
        <!-- Start Nav -->


        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div style="padding-left:15px;">
                        <a class="" href="/"><img src="/assets/images/smo_logo.png"  border="0" alt="Stepmania Online" class="g-smo-logo" /></a>
                    </div>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/">Home</a></li>
                        <li><a href="/forums">Forums</a></li>
                        <li><a href="/forums">How To Play</a></li>
                        <li><a href="/irc">Web Chat</a></li>
                        <li><a href="/forums">Downloads</a></li>
                        <li><a href="/forums">Member List</a></li>
                        <!--<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Toolbox <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/toolbox/autotuner">Autotuner</a></li>
                                <li><a href="/toolbox/displacement">Displacement Calculator</a></li>
                                <li><a href="/toolbox/speed">Speed Calculator</a></li>
                            </ul>
                        </li> -->

                        <?php if($this->session->userdata('logged_in')):?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle g-nav-username" data-toggle="dropdown"><!--<sup><span class="badge">142</span></sup>--><?php echo $user; ?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/manage">My Profile</a></li>
    									  <li class="divider"></li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                        </li>
                        <?php else: ?>

                        <li class=""><a href="/signup">Sign Up</a></li>
                        <?php endif; ?>
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- End Nav-->



<div class="container">


<div class="row">
  <div class="col-md-8">
	<?php if(!$this->session->userdata('logged_in')): ?>
		<form class="form-inline" method="post" action="/">
                <input type="username" name="username" class="form-control" placeholder="User Name" autofocus>
                <input type="password" name="pass1" class="form-control" placeholder="Password">
     


           <label class="checkbox">
                    <input type="checkbox" checked value="remember-me"> Remember me
                </label>
                <button class="btn btn-default" value="login" type="submit">Sign in</button>
                <h5><?php echo validation_errors(); ?>
                    <?php if (!$auth): ?>
                    Login is incorrect, please try again.
                    <?php endif; ?>
                </h5>
            </form>
            <?php endif; ?>



  </div>

  <div class="col-md-4">
		<form class="form" method="post" action="/">
                <input type="username" name="username" class="form-control" placeholder="User Search" autofocus>
                <input type="song" name="song" class="form-control" placeholder="Song Search">
		</form>
  </div>
</div>


</div>
