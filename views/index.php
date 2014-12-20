<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATBU HRMS</title>

    <!-- Bootstrap -->
    <link href="res/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="res/css/cover.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">ATBU HRMS</h3>
              
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">ATBU HRMS</h1>
            <p class="lead">Secure Internet-based Human Resource Management System. <br/> Submitted to the Mathematical Science Programme of Abubakar Tafawa Balewa University, in partial fulfilment for the requirement of the award of Bachelors Degree (B.Tech) in Computer Science.</p>
            <p class="lead">
            <form class="form-inline" action="" method="POST" role="form">
                    
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                        <input class="form-control" type="text" name="staff_num" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                       <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword2" placeholder="***********">
                       </div>
                    </div>
                    <input type="hidden" name="formHandler" value="signin" />
                    <button type="submit" class="btn btn-default">Sign in</button>
                  </form>
            </p>
            <p><?php echo $error; ?></p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              
                <p>Built by Maryam Muhammad Lawal (09/22536/U/1) under the supervision of Malam Badamasi Imam.</p>
                
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="res/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="res/js/bootstrap.min.js"></script>
  </body>
</html>

