<html>
   
   <head>
      <title>XC CMS </title>
         <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   

   </head>
   
   <body>
   <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">XC CMS</a>
     
           <span class="pl-2 text-primary">Welcome <?php echo $login_session; ?>, you have <?php echo $login_sessionCredits; ?> credit</span> 
        
        
    </div>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active mt-5" href="index.php">
                 
                <i class="fa fa-home fa-lg" ></i> Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="online.php">
                <i class="fa fa-user fa-lg"></i> Online Connection
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="linelist.php">
                <i class="fa fa-user fa-lg"></i> Line List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addline.php">
                <i class="fa fa-user fa-lg"></i> Add line
                </a>
              </li>
			   <li class="nav-item">
                <a class="nav-link" href="maglist.php"><i class="fa fa-tablet fa-lg"></i> MAG List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addmag.php"><i class="fa fa-tablet fa-lg"></i> Add MAG
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="streamlist.php">
                <i class="fa fa-list-alt fa-lg"></i> Stream list
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="addstream.php">
                <i class="fa fa-tv fa-lg"></i> Add stream
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bouqets.php">
                <i class="fa fa-th fa-lg"></i> Bouqets list
                </a>
              </li>
             
            </ul>

           
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="justify-content-between  align-items-center pt-5 mt-5 pb-2 mb-3 border-bottom">
          
        