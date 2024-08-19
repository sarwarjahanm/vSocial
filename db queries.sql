Create database basics

	CREATE TABLE jsdemo(fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),phone VARCHAR(10))
	CREATE TABLE dbdemo(fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),phone VARCHAR(10))
	


Create database vsocial

	CREATE TABLE users(username VARCHAR(30),password VARCHAR(25),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250))
	CREATE TABLE admins(username VARCHAR(30),password VARCHAR(25),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250))
	CREATE TABLE bloggers(username VARCHAR(30),password VARCHAR(25),fname VARCHAR(30),lname VARCHAR(30),address VARCHAR(250),pic VARCHAR(250))
	CREATE TABLE blogs(author VARCHAR(30),title VARCHAR(250),body VARCHAR(1500))
	CREATE TABLE messages(username VARCHAR(30),message VARCHAR(300),sender VARCHAR(30))