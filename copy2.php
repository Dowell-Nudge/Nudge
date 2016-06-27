<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

 
<?php
require 'config.php';

echo $_SESSION['name']; 

$category = ""; 
$category = $_SESSION['category'];
 
if(!empty($_POST['name'])){     
	 $name=$_POST['name'];
     $email=$_POST['email'];
     $category=$_POST['category'];
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysqli_insert_id($con);
}
$_POST['category'] = $category; 


//Verify an answer choice was made before moving on to the next page. 
$answerErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['theanswer'])){
		$_SESSION['theanswer'] = $_POST['theanswer']; 
		echo $_SESSION['name'];  
		header("Location: storyloop.php"); 
		exit(); 
	} else{
		$answerErr = "Please select an answer choice to move on."." ".$_SESSION['name']; 
		
	}
}// End of answer choice verification
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nudge | Dowell Lab</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
       
         <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/main.css" rel="stylesheet" media="screen">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen"> 
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="../../assets/js/html5shiv.js"></script>
        <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
        <style>
            .container {
                margin-top: 110px;
            }
            .error {
                color: #B94A48;
            }
            .form-horizontal {
                margin-bottom: 0px;
            }
            .hide{display: none;}
        </style>
    </head>

    <body ng-controller="MyController">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="index.html"><img src="assets/img/logo.png" width="100px"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="index.php">USE NUDGE</a></li>
            <li class='active'><a href="comments.php">COMMENTS</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
    </div>
        <header>
            <p class="text-center">
                Welcome to nudge: <?php if(!empty($_SESSION['name'])){echo $_SESSION['name'];}?>
            </p>
        </header>
 
        <div class="container question">
            <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
                <p>
                    Responsible conduct of research
                </p>
                <span class="help-block"><?php echo $answerErr;?></span>
                <hr>
                <form class="form-horizontal" role="form" id='login' method="post">
                    <?php
                    $res = mysqli_query($con, "select * from storytable where storytitle='$category' and position=0") or die(mysql_error());
                    $row = mysqli_fetch_row($res);
					$thirdcol = $row[3];
					echo nl2br("\n");
					print($thirdcol); //prints storyline from storytable
					$i=1;
					?>
				</form>
				<form class="form-horizontal" role="form" id='login' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <?php
						$_SESSION['storylinetite']='start';
						$res2 = mysqli_query($con, "select * from answers where storylinetite='start' and storytitle='$category';") or die(mysql_error());
						$n=1;
					?>
				<div id='question<?php echo $i;?>' class='cont'>
                  <br/>
				<?php while($row2 = mysqli_fetch_array($res2)){?>
				<input type="radio" value="<?php echo htmlspecialchars($row2['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row2['answerchoice'];?>
				  <br/>
				<?php $n++; }?>
		          <br/>
				</div>
				<button class="btn btn-success btn-block" type="submit">Next</button>
				  <span class="help-block"><?php echo $answerErr;?></span>
				</form>
		        </hr>
            </div>
	   </div>

       <footer>
            <p class="text-center" id="foot">
                &copy; <a href="http://dowell.colorado.edu/" target="_blank">Dowell Lab </a>2013
            </p>
        </footer>
 
    </body>
</html>

