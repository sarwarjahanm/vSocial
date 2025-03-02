This PHP vulnerable web app is built for educational purpose only to understand and learn Web Application Firewall concepts. Host it in a VM or XAMPP server locally. 
Below are the instructions for setting up the environment:

Step 1: Download XAMPP from https://www.apachefriends.org/ 
Step 2: Configure XAMPP (open httpd.conf - Apache server configuration)
        Search for Listen 80 and change port to 81
Step 3: phpmyadmin - Database setup for Demo apps
            a. Access http://localhost:81/phpmyadmin/index.php
            b. Click on New and Create database **basics** 
            c. Click on database **basics** from left panel, then click **SQL** tab on right panel and execute following queries
CREATE TABLE jsdemo(fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),phone VARCHAR(10));
CREATE TABLE dbdemo(fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),phone VARCHAR(10));
            d. Click on New and Create database **vsocial** 
            e. Click on database **vsocial** from left panel, then click **SQL** tab on right panel and execute following queries
   CREATE TABLE users(username VARCHAR(30),password VARCHAR(25),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));
   CREATE TABLE admins(username VARCHAR(30),password VARCHAR(25),role CHAR(1),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));
   CREATE TABLE bloggers(username VARCHAR(30),password VARCHAR(25),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250));
   CREATE TABLE blogs(author VARCHAR(30),title VARCHAR(250),body VARCHAR(1500));
   CREATE TABLE messages(username VARCHAR(30),message VARCHAR(500),sender VARCHAR(30));
   CREATE TABLE logs(url VARCHAR(200),timestamp VARCHAR(50),description VARCHAR(2000));
   INSERT INTO `admins`(`username`, `password`, `role`) VALUES('admin','admin','A');
   INSERT INTO `admins`(`username`, `password`, `role`) VALUES('Steve','steve','A');
   INSERT INTO `admins`(`username`, `password`, `role`) VALUES('Bob','bob','A');
   INSERT INTO `admins`(`username`, `password`, `role`) VALUES('Super','super','S');

Step 4: Download Demo Apps from
   https://github.com/sarwarjahanm/vSocial
   https://github.com/sarwarjahanm/Basics
Step 5: Put Demo apps in XAMPP-htdocs
     C:\xampp\htdocs\
Step 6: Access Demo Apps using Browser     
 JavaScript & HTML Basic app:
  http://localhost:81/Basics/JS/withoutJS.html
  http://localhost:81/Basics/JS/withJS.html
  http://localhost:81/Basics/JS/DOMjs.html
  
 Database Basic app:
  http://localhost:81/Basics/DB/Main.html
  
 vSocial:
  http://localhost:81/Vsocial/Home.php
