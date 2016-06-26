#Developer Overview
***

This directory explains the contents of the core files for Nudge.      
<br> 
Shown below is a list of the main files. Each contains a combination of HTML5, CSS, PHP, and JavaScript/jQuery code.           
* Main Files 
 * [index.php](#index-php)    
 * copy2.php     
 * storyloop.php     
 * newuser.php   
 * index.html   
 * about.html   
 
####Program Flow for Game-Play
index.php is used as the login/sign-up page. After login credentials are verified, copy2.php is called. This file is responsible for displaying the start of the story-line selected by the user in the dropdown category list from index.php. Along with the start of the selected story-line, copy2.php also displays the decisions the user can select for that starting scenario. Once a decision is selected by the user and they submit their answer by clicking next, storyloop.php is then called. This file renders the remaining outcomes and decisions for each storyline. Below is a description of each file, with a user section and a technical section.      

##index.php  
***

#### User Doc (index.php)

**Existing User**    
index.php is the sign-in/sign-up page for Nudge. If you currently have a username and password for the system you can login by typing in your username and password, then select a category for the type of story-line you
would like to play.     

**Create an Account**              
If you do not have a username or password, there is a text area for you to input the desired username, email address, and a password to create an account on Nudge.  

#### Technical Doc (index.php)

Style Sheets Linked [https://github.com/Dowell-Nudge/Nudge/tree/master/assets/css](https://github.com/Dowell-Nudge/Nudge/tree/master/assets/css):          
* bootstrap.css
* main.css
* font-awesome.min.css    

**PHP/MySQL Driver Functions**    

| Name of Function     | Purpose     | Return Type     | 
| -------------------- | --------------- | --------------------- |
| *session_start()*    | [Explained Here](http://php.net/manual/en/function.session-start.php) | Boolean   |
| *htmlspecialchars($_SERVER["PHP_SELF"])* | Check if information has been submitted by the user (input validation) | Boolean | 
| *require(config.php)* | Connect to Database | Boolean          |
| *isset($_POST['newUser'])* | Check if a user is creating a new account | Boolean        |
| *filter_var($email, FILTER_VALIDATE_EMAIL)* | Validate email variable is in proper format | Boolean	  |
| *mysqli_query()* | Performs a query against the database   | String	  |
| *mysqli_fetch_array()* | Returns an array of strings that corresponds to the fetched row   | Array of strings |
| header() | Redirects user to a new page | Boolean | 
| *unset($_SESSION['name']);* | Clear Username | Boolean	  |
| *empty($_SESSION['name'])* | Check if Username Exists | Boolean |
| *trim()* | Removes whitespace from a string   | String	  |
| *stripslashes()* | Removes slashes from a string   | String	  |

**PHP/MySQL Driver Variables**    

| Name of Variable     | Purpose     | Type     | 
| -------------------- | --------------- | --------------------- |
| *$userPassErr*    | Error message for no password given | String   |
| *$catErr* | Error message for no category chosen | String | 
| *$newUserErr* | Error message for invalid username | String          |
| *$emailErr* | Error message for invalid email address | String        |
| *$newPassErr* | Error message for no password given | String	  |
| *$name* | The current user's name attempting to login   | String	  |
| *$email* | The current user's password | String |
| *$category* | Selected category by user attempting login | String | 
| *$password* | Password for new account creation | String	  |
| *$_SESSION['name']* | Current user's username | Session String |
| *$_SESSION['category']* | Selected category by user logging in   | Session String	  |
| *$_POST["name"]* |  User input from 'signin'    | Post String	  |
| *$_POST["email"]* | User input from 'signin'   | Post String	  |
| *$_POST["category"]* | User input from 'signin'   | Post String	  |
| *$_POST["password"]* | User input from 'signin'   | Post String	  |

**Main HTML Elements**    

| Type of Element     | Class/Id of Element                            | line in index.php     | 
| ------------------- | ---------------------------------------------- |:---------------------:| 
| Fixed Nav-Bar       | class="navbar navbar-inverse navbar-fixed-top" | Line 41 to 59         |
| Form                | class="form-signin"                            | Line 80 to 149        |
| footer              | id="foot"                                      | Line 155 to 157       | 


## copy2.php  
***

#### User Doc (copy2.php)

After entering your credentials on the Nudge homepage, selecting a category, and clicking the next button to submit your information, if everything is correct you will come to the start of the game. You will be presented with the beggining of the story category that you chose on the previous page. You have options below that allow you to make a decision and begin your ethical journey through the rest of the developing story. Upon clicking next, you will be navigated to one of the possible outcomes as a consequence of the decision you chose.
  
#### Technical Doc (copy2.php)

PHP Functions    

| Name of Function     | Purpose     | line in copy2.php     | 
| -------------------- | --------------------- | --------------------- |
| *session_start()*    | [Explained Here] | Line 2    |
| *require(config.php)* | Connect to Database | Line 10           |
| *empty($_SESSION['name'])* | Check if Username Exists | Line 13 |
| *mysql_query(<MySQL statement>)* | 
| *unset($_SESSION['name']);* | Clear Username | Line 62	  |

[Explained Here]: http://php.net/manual/en/function.session-start.php

 
