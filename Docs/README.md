#Developer Overview
***

This directory explains the contents of the core files for Nudge.      
<br> 
Shown below is a list of the main files. Each contains a combination of HTML5, CSS, PHP.           
* Main Files 
 * [index.php](#indexphp)    
 * [copy2.php](#copy2php)     
 * [storyloop.php](#storyloopphp)     
 * [newuser.php](#newuserphp)   
 * [index.html](#indexhtml)   
 * [about.html](#abouthtml)   
* MySQL Database
 * [nudge](#nudge)   
 
####Program Flow for Game-Play
index.php is used as the login/sign-up page. After login credentials are verified, they are inserted into the 'users' table in the nudge database, then copy2.php is called. This file is responsible for displaying the start of the story-line selected by the user in the dropdown category list from index.php. The beginning story-scenario is queried from the 'storytable' table and displayed. Along with the start of the selected story-line, copy2.php also renders the decisions the user can select for that starting scenario by querying the 'answers' table. Once a decision is selected by the user and they submit their answer by clicking next, storyloop.php is then called. This file renders the remaining outcomes and decisions for each storyline utilizing the 'results', 'storytable', and 'answers' tables from the nudge database. Below is a description of each file, with a user section and a technical section.      

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
| *$randnum* | Random number between 0 and 100, generated for underlying probability model | Integer | 
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

## newuser.php  
***

#### User Doc (newuser.php)

After entering the correct credentials on the Nudge homepage for creating a new acccount you will be brought to this newuser.php. This page is responsible for displaying a thank you message and confirming that your account was created. There is a link on the page to click in order to go back to the login screen in order to login to the system. 
  
#### Technical Doc (newuser.php)

**Main HTML Elements**    

| Type of Element     | Class/Id of Element                            | line in index.php     | 
| ------------------- | ---------------------------------------------- |:---------------------:| 
| div       | *class="navbar navbar-inverse navbar-fixed-top"* | Line 40 - 58         |
| Header                | *<header>*                           | Line 59 - 63        |
| div              | *class="centered"*                                    | Line 64 - 67       | 
| Footer	| *<footer>* | Line 68 - 72 |

## index.html  
***

#### User Doc (index.html)

You can reach this page from anywhere on the Nudge website by clicking on the 'Home' indentifier in the Navigation Bar on the top of any page. This page displays the purpose of the Nudge project and the source of funding.  
  
#### Technical Doc (index.html)

| Type of Element     | Class/Id of Element                            | line in index.php     | 
| ------------------- | ---------------------------------------------- |:---------------------:| 
| div       | *class="navbar navbar-inverse navbar-fixed-top"* | Line 31 - 51         |
| div                | *id="headerwrap"*                           | Line 53 - 62        |
| div              | *<div id="r">*                                    | Line 135 - 147       | 
| div              | *<div id="lg">*                                    | Line 149 - 159       | 
| div	| *id="f"* | Line 163 - 171 | 
| div              | *class="modal fade"*                               | Line 207 - 176       |


## about.html  
***

#### User Doc (about.html)

This page displays the team that created Nudge. There are pictures of the developers and contributors along with their contact information. 
    
#### Technical Doc (about.html)

| Type of Element     | Class/Id of Element                            | line in index.php     | 
| ------------------- | ---------------------------------------------- |:---------------------:| 
| div       | *class="navbar navbar-inverse navbar-fixed-top"* | Line 33 - 53         |
| div                | *id="blue"*                           | Line 55 - 64        |
| div              | *id="container w"*                                    | Line 67 - 106       | 
| div              | *class="col-lg-3"*                                    | Line 70 - 75       |
| div              | *<class="col-lg-3"*                                    | Line 77 - 82       |
| div              | *class="col-lg-3"*                                    | Line 84 - 89       |
| div              | *class="col-lg-3"*                                    | Line 91 - 96       |
| div              | *class="col-lg-3"*                                    | Line 98 - 103       |
| div              | *<div id="r">*                                    | Line 208 - 217        |
| div	| *id="f"* | Line 221 - 227 | 
| div              | *class="modal fade"*                               | Line 232 - 263       |


## nudge

The name of the database utilized by Nudge is named nudge. Below are the tables and data definitions for the nudge database. There are two tables in the database, 'categories' and 'questions', which will not be mentioned because they are not used for Nudge itself.  

**Nudge Database**
| Tables | 
| ------ | 
| answers | 
| comments | 
| play | 
| played | 
| results | 
| rewardss | 
| storytable | 
| users | 

###Data Definitions for Each Table
***

#### answers 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | storytitle | text | NULL |
| 2 | storylinetite | text | NULL |
| 3 | answer | tinytext | NULL |
| 4 | answerchoice | longtext | NULL |
     
#### comments 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | NULL |
| 2 | name | varchar(30) | NULL |
| 3 | email | varchar(30) | NULL |
| 4 | comment | varchar(100) | NULL |

#### play

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | AUTO_INCREMENT |
| 2 | name | varchar(255) | NULL |
| 3 | storyname | varchar(255) | NULL |
| 4 | ending | varchar(255) | NULL |

#### played 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | AUTO_INCREMENT |
| 2 | name | varchar(255) | NULL |
| 3 | e1 | int(11) | NULL |
| 4 | e2 | int(11) | NULL |
| 5 | e3 | int(11) | NULL |
| 6 | e4 | int(11) | NULL |
| 7 | e5 | int(11) | NULL |
| 8 | e6 | int(11) | NULL |
| 9 | e7 | int(11) | NULL |
| 10 | e8 | int(11) | NULL |

#### results 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | NULL |
| 2 | storytitle | text | NULL |
| 3 | storylinetite | text | NULL |
| 4 | answer | tinytext | NULL |
| 5 | startprob | int(11) | NULL |
| 6 | stopprob | int(11) | NULL |
| 7 | gotostorylinetite | text | NULL |

#### rewardss 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | AUTO_INCREMENT |
| 2 | reward | varchar(255) | NULL |
| 3 | statement | text | NULL |
| 4 | points | int(11) | NULL |
| 5 | end_id | int(11) | NULL |
| 6 | image | blob | NULL |
| 7 | end | varchar(4) | NULL |

#### storytable 
| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | NULL |
| 2 | storytitle | text | NULL |
| 3 | storylinetite | text | NULL |
| 4 | storyline | longtext | NULL |
| 5 | position | int(11) | NULL |


#### users 

| # | Name | Type | Default | 
| ------ | ---- | ---- | ---- |
| 1 | id | int(11) | AUTO_INCREMENT |
| 2 | user_name | varchar(50) | NULL |
| 3 | score | int(11) | NULL |
| 4 | category_id | int(11) | NULL |
| 5 | name | varchar(22) | NULL |
| 6 | password | varchar(255) | NULL |







