<?php
/*
$conn = new mysqli('localhost', 'root', '');
$query = 'CREATE DATABASE urban_dictionary';
$conn->query($query) or die ($conn->error);
*/
$conn = new mysqli('localhost', 'root', '', 'urban_dictionary');
/*
$query = "CREATE TABLE users(
  id int NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
  username varchar(20) NOT NULL UNIQUE,
  password varchar(255) NOT NULL,
  email varchar(50) NOT NULL,
  user_type enum('basic', 'admin')
)";

$conn->query($query) or die ($conn->error);
*/
$query = "CREATE TABLE categories(
  id int NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY,
  title varchar(50) NOT NULL UNIQUE,
  author varchar(20) NOT NULL,
  FOREIGN KEY(author) REFERENCES users(username) ON DELETE CASCADE
)";

$conn->query($query) or die ($conn->error);

$query = "CREATE TABLE entries(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title varchar(50) NOT NULL UNIQUE ,
  author varchar(20) NOT NULL,
  submission_date DATE,
  context varchar(100),
  content varchar(1000),
  FOREIGN KEY(author) REFERENCES users(username) ON DELETE CASCADE
)";

$conn->query($query) or die ($conn->error);


$query = "CREATE TABLE category_entries(
  entryID int NOT NULL,
  categoryID int NOT NULL,
  submission_date DATE,
  PRIMARY KEY(entryID, categoryID),
  FOREIGN KEY(entryID) REFERENCES entries(id),
  FOREIGN KEY(categoryID) REFERENCES categories(id)
)";

$conn->query($query) or die ($conn->error);

?>
