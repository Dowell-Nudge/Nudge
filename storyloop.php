<?php
session_start();
?>
<!---
Site : http:www.smarttutorials.net
Author :muni
--->

<?php
require 'config.php';
$category='';
if(!empty($_POST['name'])){
     $name=$_POST['name'];
     $category=$_POST['category'];
     mysqli_query($con, "INSERT INTO users (id, user_name,score,category_id)VALUES ('NULL','$name',0,'$category')") or die(mysql_error());
     $_SESSION['name']= $name;
     $_SESSION['id'] = mysql_insert_id();
}
$category=$_SESSION['category'];
$theanswer=$_SESSION['theanswer'];
$storylinetite=$_SESSION['storylinetite'];

//Verify an answer choice was made before moving on to the next page. 
$answerErr = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(!empty($_POST['theanswer'])){
		$_SESSION['theanswer'] = $_POST['theanswer']; 
		$_SESSION['storylinetite']=$_SESSION['gotostorylinetite'];
		header("Location: storyloop.php"); 
		exit();
	} else{
		$answerErr = "Please select an answer choice to move on."; 
	}
}// End of answer choice verification


if(!empty($_SESSION['name'])){
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Responsive Quiz Application Using PHP, MySQL, jQuery, Ajax and Twitter Bootstrap</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap >
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="assets/css/style.css" rel="stylesheet" media="screen"-->
        
        <!-- Using style sheets for local server, remove later--> 
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
                <form class="form-horizontal" role="form" id='loadStory' method="post">
                    <?php
						$pos = -1; //initialize position to negative one. This is for the event that the user forgets to select an answer. 
									// We still want to display the previous scenario and answer choices. $pos holds the value of whether the current scenario is an end, beginning, or middle
						$randnum=rand(0,100);
						
						$result = mysqli_query($con, "select gotostorylinetite  from results where storytitle='$category' and storylinetite='$storylinetite' and answer='$theanswer' and startprob<'$randnum' and stopprob>='$randnum';"); 

						$row_cnt = mysqli_num_rows($result);
						
						$row = mysqli_fetch_row($result); // $row at this point only contains one value, the title of the next scenario, known as gotostorylinetite. 
						
						if(!empty($row)){
							$gotostorylinetite = $row[0]; 
							echo nl2br("\n");
							$res = mysqli_query($con, "select * from storytable where storytitle='$category' and storylinetite='$gotostorylinetite'") or die(mysql_error());
							$row = mysqli_fetch_row($res);
							$secondcol = $row[2]; // secondcol contains storylinetite(I call this the scenario title)
							$thirdcol = $row[3]; // thirdcol contains the storyline for the scenario title
							$pos = $row[4]; // pos keeps track of whether the current scenario title is a start - 0   end - 1   or   middle - 2
							echo nl2br("\n");
							print($thirdcol); 
							$i=1;
							$_SESSION['gotostorylinetite'] = $gotostorylinetite;  
						} else {
							//Do nothing because an answer was not selected and we want to load the same scenario and answers from before. Do this until the user 
							// chooses an answer choice. 
						}
					?>
				</form>
		<?php if($pos!=1){?>
			<form class="form-horizontal" role="form" id='login' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <?php
				$res2 = mysqli_query($con, "select * from answers where storylinetite='$gotostorylinetite' and storytitle='$category';") or die(mysql_error());
		    ?>
			<div id='question<?php echo $i;?>' class='cont'>
				<br/>
				<?php while($row = mysqli_fetch_array($res2)){?>
					<input type="radio" value="<?php echo htmlspecialchars($row['answer']); ?>" name="theanswer" /><?php echo " ";?><?php echo $row['answerchoice'];?>
					<br/>
				<?php }?>	
				<br/>	
		    </div>
		    <button class="btn btn-success btn-block" type="submit">Next</button>
            </form>
		<?php } else {?>
 
<?php  
$K=$row[0];
$final= mysqli_query($con, "select * from rewardss where end_id='$K';") or die(mysql_error());
$finalrow = mysqli_fetch_row($final);
$statement = $finalrow[2];
$points = $finalrow[3];
$endid = $finalrow[6];
$name=  $_SESSION['name'];
$QU= mysqli_query($con, "select * from users where name ='$name';") or die(mysql_error());
$QRow= mysqli_fetch_row($QU);
$score = $QRow[2];


$in = mysqli_query($con, "INSERT INTO  play(name, storyname, ending) VALUES('$name', '$category', '$endid')") or die(mysql_error());  
$total= $score+$points;

$count = mysqli_query($con, "SELECT COUNT(Distinct ending) from play where storyname='$category' and name='$name';") or die(mysql_error());
$scorerow = mysqli_fetch_row($count);

?>
 
  <h3> <?php print($statement); ?> </h3>
  <h3> Worth  <?php print($points); ?>  points! </h3>

<?php  mysqli_query($con, "UPDATE users SET score=$total WHERE name ='$name';"); 


$tots2 = mysqli_query($con, "SELECT COUNT(*) from rewardss;");
$tots = mysqli_fetch_row($tots2);

?>
<br>
<h3> You have reached <?php print($scorerow[0]); ?>/<?php print($tots[0]); ?> different endings!
<h3> You now have <?php print($total); ?> total points! </h3>
<br>
<h3> 
<a href="http://dowell.colorado.edu/nudge/index.php">Please Play Again! </a>
</h3>
<br>
<br>

<?php  } ?>


		</hr>
            </div>
	</div>

       <footer>
            <p class="text-center" id="foot">
                <a href="http://dowell.colorado.edu" target="_blank">Dowell Lab Home </a>2014
            </p>
        </footer>
 
<?php } else{
			echo "Oh no"; 
		}?>
 
    </body>
</html>
 

