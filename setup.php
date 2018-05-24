<?php
/*
$conn = new mysqli('localhost', 'root', '', 'urban_dictionary');

if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
}
echo "connected yo <br>";


$query = "CREATE TABLE users(
  username VARCHAR(20) NOT NULL UNIQUE PRIMARY KEY,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(50) NOT NULL,
  user_type ENUM('basic', 'admin')
)";

$conn->query($query) or die ($conn->error);

$query = "CREATE TABLE categories(
  title VARCHAR(50) NOT NULL UNIQUE PRIMARY KEY,
  author VARCHAR(20) NOT NULL,
  FOREIGN KEY(author) REFERENCES users(username)
)";

$conn->query($query) or die ($conn->error);

$query = "CREATE TABLE entries(
  title VARCHAR(50) NOT NULL UNIQUE PRIMARY KEY,
  author VARCHAR(20) NOT NULL,
  submission_date DATE,
  context VARCHAR(100),
  content VARCHAR(1000),
  FOREIGN KEY(author) REFERENCES users(username)
)";

$conn->query($query) or die ($conn->error);

$query = "CREATE TABLE category_entries(
  category VARCHAR(50) NOT NULL,
  entry VARCHAR(50) NOT NULL,
  PRIMARY KEY(category, entry),
  FOREIGN KEY(category) REFERENCES categories(title),
  FOREIGN KEY(entry) REFERENCES entries(title)
)";

$conn->query($query) or die ($conn->error);
*/
?>
