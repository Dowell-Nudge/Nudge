#Developer Overview
***

This directory explains the contents of the core files for Nudge.      
<br> 
Shown below is a list of the main files. Each contains a combination of HTML5, CSS, PHP, and JavaScript/jQuery code.           
* Main Files 
 * [index.php](#indexphp)    
 * [copy2.php](#copy2php)     
 * [storyloop.php](#storyloopphp)     
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
| *mysql_query()* | Performs a query against the database   | String	  |
| *mysql_fetch_array()* | Returns an array of strings that corresponds to the fetched row   | Array of strings |
| header() | Redirects user to a new page | Boolean | 
| *unset($_SESSION['name']);* | Clear Username | Boolean	  |
| *empty($_SESSION['name'])* | Check if Username Exists | Boolean |
| *trim()* | Removes whitespace from a string   | String	  |
| *stripslashes()* | Removes slashes from a string   | String	  |
| *test_input()* | Removes slashes and white space string and encodes the input | Boolean |
| *valid_password()* | Ensures a password has at least 5 characters containing at least 1 number | Boolean | 

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

**PHP/MySQL Driver Functions**    

| Name of Function     | Purpose     | Return Type     | 
| -------------------- | --------------- | --------------------- |
| *session_start()*    | [Explained Here](http://php.net/manual/en/function.session-start.php) | Boolean   |
| *htmlspecialchars($_SERVER["PHP_SELF"])* | Check if information has been submitted by the user (input validation) | Boolean | 
| *htmlspecialchars($row2['answer'])* | Encode answer choices for output | 
| *require(config.php)* | Connect to Database | Boolean          |
| *isset($_POST['newUser'])* | Check if a user is creating a new account | Boolean        |
| *filter_var($email, FILTER_VALIDATE_EMAIL)* | Validate email variable is in proper format | Boolean	  |
| *mysql_query()* | Performs a query against the database   | String	  |
| *mysql_fetch_array()* | Returns an array of strings that corresponds to the fetched row   | Array of strings |
| header() | Redirects user to a new page | Boolean | 
| *unset($_SESSION['name']);* | Clear Username | Boolean	  |
| *empty($_SESSION['name'])* | Check if Username Exists | Boolean |

**PHP/MySQL Driver Variables**    

| Name of Variable     | Purpose     | Type     | 
| -------------------- | --------------- | --------------------- |
| *$answerErr*    | Error message for no answer selected | String   |
| *$name* | The current user's name   | String	  |
| *$email* | The current user's password | String |
| *$category* | Selected category by user | String | 
| *$con* | Connection to database info | String |
| *$res* | Contains MySQL query to select the beginning of the story category | String |
| *$row* | Contains the information from the *$res* select statement | String |
| *$thirdcol* | The beginning storyline from the third column in *row*  | String |
| *$res2* | Contains MySQL query to select the answer choices for the beginning storyline | String |
| *$row2* | Contains the information from the *$res2* select statement | Array of Strings |
| *$_SESSION['theanswer']* | Answer selected by user | Session String	  |
| *$_SESSION['name']* | Current user's username | Session String |
| *$_SESSION['category']* | Selected category by user   | Session String	  |
| *$_SESSION['storylinetite']* | Set to start because copy2.php begins the game | Session String | 
| *$_POST["name"]* |  Username from login    | Post String	  |
| *$_POST["email"]* | User's password from login   | Post String	  |
| *$_POST["category"]* | Selected Category at login   | Post String	  |
| *$_POST["theanswer"]* | Selected answer   | Post String	  |
 
## storyloop.php  
***

#### User Doc (storyloop.php)
Once you have reached this file, you are in the middle of the game. This page is responsible for keeping the game going, ending the game, and displaying your results. Scenarios and decision choices are displayed for you to choose your path in the story-line. After a decision is made, the outcome of that decision will be displayed. From here, if it is not an ending scenario, you will be able to choose another decision until you reach one of the nine endings in the game. 

#### Technical Doc (storyloop.php)

**PHP/MySQL Driver Functions**    

| Name of Function     | Purpose     | Return Type     | 
| -------------------- | --------------- | --------------------- |
| *session_start()*    | [Explained Here](http://php.net/manual/en/function.session-start.php) | Boolean   |
| *htmlspecialchars($_SERVER["PHP_SELF"])* | Check if information has been submitted by the user (input validation) | Boolean | 
| *htmlspecialchars($row2['answer'])* | Encode answer choices for output | 
| *require(config.php)* | Connect to Database | Boolean          |
| *isset($_POST['newUser'])* | Check if a user is creating a new account | Boolean        |
| *filter_var($email, FILTER_VALIDATE_EMAIL)* | Validate email variable is in proper format | Boolean	  |
| *mysql_query()* | Performs a query against the database   | String	  |
| *mysql_fetch_array()* | Returns an array of strings that corresponds to the fetched row   | Array of strings |
| header() | Redirects user to a new page | Boolean | 
| *unset($_SESSION['name']);* | Clear Username | Boolean	  |
| *empty($_SESSION['name'])* | Check if Username Exists | Boolean |

**PHP/MySQL Driver Variables**    

| Name of Variable     | Purpose     | Type     | 
| -------------------- | --------------- | --------------------- |
| *$answerErr*    | Error message for no answer selected | String   |
| *$name* | The current user's name   | String	  |
| *$category* | Selected category by user | String | 
| *$pos* | Contains numerical code to distinguish if the current scenario in the game is a beginning - 0 , middle - 2 , or end - 1 | Integer | 
| *$result* | MySQL SELECT statement to retrieve current scenario story | String| 
| *$con* | Connection to database info | String |
| *$res* | Contains MySQL query to SELECT the beginning of the story category | String |
| *$row* | Contains the information from the *$res* select statement | String |
| *$thirdcol* | The beginning storyline from the third column in *row*  | String |
| *$res2* | Contains MySQL query to SELECT the answer choices for the beginning storyline | String |
| *$row2* | Contains the information from the *$res2* select statement | Array of Strings |
| *$K* | Numerical code correspoding to ending reward | Integer |
| *$final* | MySQL query statement to SELECT the reward for the ending ID in *$K* | String |
| *$finalrow* | Array containing the information from the *$final* query statement | Array of Strings |
| *$statement* |  Explanation of the reward to be presented to the user | String | 
| *$points* | Points received for making it to that particular ending | Integer | 
| *$endid* | Identifier for the ending you made it to | String | 
| *$QU*  | MySQL query statement to SELECT all user information | String | 
| *$QRow*  | The row obtained from the *QU* query statement after execution | Array of Strings | 
| *$score* | The total score of the user from the second index of *QRow* | Integer | 
| *$in*   | MySQL query statement to INSERT the players ending and category information into the database | String | 
| *$total* | *$score* + *$points* is the user's total score | Integer | 
| *$count* | MySQL SELECT COUNT statement to count how many different endings the user has made it to | String | 
| *$scorerow* | Row of information retrieved by executing the *$count* statement | Array of Strings | 
| *$tots2* | MySQL SELECT statement to count the number of endings possible in the game | String | 
| *$tots*  | Row of information returned by *$tots2* query | Array of Strings | 
| *$_SESSION['theanswer']* | Answer selected by user | Session String	  |
| *$_SESSION['name']* | Current user's username | Session String |
| *$_SESSION['category']* | Selected category by user   | Session String	  |
| *$_SESSION['storylinetite']* | Set to start because copy2.php begins the game | Session String | 
| *$_POST["name"]* |  Username from login    | Post String	  |
| *$_POST["theanswer"]* | Selected answer   | Post String	  |
 

