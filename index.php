<?php
require_once './php/db_connect.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <title>p6</title>
    
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!--    autocomplete-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    
    <!-- JavaScript and jQuery CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    
<!--    Allow AJAX to work-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="script/validation.min.js"></script>
    <script type="text/javascript" src="script/p6.js"></script>
    <script type="text/javascript" src="script/autohint.js"></script>
    
    
    
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
    

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/one-page-wonder.min.css" rel="stylesheet">
  
  <link href="css/p6.css" rel="stylesheet">
    
    
    
  </head>
  <body>
    
    
      <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Top Voted Baby Names</a>
    </div>
  </nav>
    
  
<!--    Boys section-->
    
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-2">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/babyboy.png" alt="">
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4 boys_title">Boys</h2>
            <table class="table" id="display_boys"></table>
          </div>
        </div>
      </div>
    </div>
  </section>

    
    <!--    Girls section-->
  <section>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="p-5">
            <img class="img-fluid rounded-circle" src="img/babygirl.png" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-5">
            <h2 class="display-4">Girls</h2>
            <table class="table" id="display_girls"></table>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!--    Form section-->
    
  <section>
    <div class="container">
      <div class="row align-items-center">

        <div class="col-lg order-lg-1">
          <div class="p-5">
            <h2 class="display-4 vote_title">Vote for your favorite baby name!</h2>
              <div class="container">
                  <form method="post" id="babyName-form"> 		

                      <div class="row">	

                        <div class="col-md-4">
                          <div class="ui-widget">
                            <input type="text" placeholder="Favorite Baby Name" name="nameDescription" id="nameDescription"/>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="gender_label">
                            <label>Gender</label>
                            <select name="gender" id="gender">

                                <option value="M">Boy</option>
                                <option value="F">Girl</option>


                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="vote_btn"><button type="submit" name="vote" id="vote" class="btn btn-success">VOTE</button></div>	
                        </div>

                    </div>
                  </form>	

                  <div class="form-group" id="error_result"></div>	

                      <div id="confirm_msg"></div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <p class="m-0 text-center text-white small">Rosalba Monterrosas 2019. All Rights Reserved. Theme by <a href="https://startbootstrap.com/">Start Bootstrap</a></p>
    </div>

  </footer>


    
    
    
  
        
<?php
// Create VOTEDBABYNAMES table 
$createStmt = 'CREATE TABLE `VOTEDBABYNAMES` (' . PHP_EOL
            . '  `id` int(11) NOT NULL AUTO_INCREMENT,' . PHP_EOL
            . '  `name` varchar(50) DEFAULT NULL,' . PHP_EOL
            . '  `gender` char DEFAULT NULL,' . PHP_EOL
            . '  `count` int DEFAULT NULL,' . PHP_EOL
            . '  PRIMARY KEY (`id`)' . PHP_EOL
            . ') ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;';
?>


<?php
  if($db->query($createStmt)) {
      echo '        <div class="alert alert-success">Table creation successful.</div>' . PHP_EOL;
  } // else if table has already been created, do nothing

?>
        
    </body>
</html>
    