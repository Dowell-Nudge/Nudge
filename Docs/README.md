#Developer Overview
***

This directory explains the contents of the core files for Nudge.      
<br> 
There are three files that make up the meat of this project containing a combination of HTML5, CSS, PHP, and JavaScript/jQuery code.           
* Main Files 
 1. index.php    
 2. copy2.php     
 3. storyloop.php     
<br>
index.php is used as the login/sign-up page. After login credentials are verified, copy2.php is called. This file is responsible for displaying the start of the story-line selected by the user in the dropdown category list from index.php. Along with the start of the selected story-line, copy2.php also displays the decisions the user can select for that starting scenario. Once a decision is selected by the user and they submit their answer by clicking next, storyloop.php is then called. This file renders the remaining outcomes and decisions for each storyline. Below is a description of each file, with a user section and a technical section.      

## index.php  
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

Main HTML Elements    

| Type of Element     | Class/Id of Element                            | line in index.php     | 
| ------------------- | ---------------------------------------------- |:---------------------:| 
| Fixed Nav-Bar       | class="navbar navbar-inverse navbar-fixed-top" | Line 41 to 59         |
| Form                | class="form-signin"                            | Line 80 to 149        |
| footer              | id="foot"                                      | Line 155 to 157       | 

JavaScript Functions   

| Name of Function     | Return Type     | line in index.php     | 
| -------------------- | --------------- | --------------------- |
| *validateCategory()* | boolean         | Line 21 to 30         | 


jQuery Functions    

| Name of Function     | Return Type     | line in index.php     | 
| -------------------- | --------------- | --------------------- | 
| *validate()*         | boolean         | Line 166 to 218       | 

#### Form (index.php) 

When the sign-in form is submitted by a current user, two different types of the form data are verified using JavaScript and jQuery.
The jQuery validate() function is explained [HERE](https://jqueryvalidation.org/validate) and confirms that all form data was properly filled out. 
Also, included in the class="form-signin" form is an onsubmit . Written as follows:      
<br>
*onsubmit="return validateCategory()"*
<br>
The onsubmit attribute checks the boolean value returned by *validateCategory()*. The purpose of *validateCategory()* is to make sure a category has been selected by the user after entering their login credentials. If the user signs in with a username and password and fails to choose a category, a message will be displayed that reads, "Please select a category from the dropdown list." *validateCategory()* can be found in the <head> section of the index.php file on line 21 to 30      




  

 
