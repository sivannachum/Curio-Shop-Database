<?php

  /**
   * Open a connection via PDO to create a
   * new database and table with structure.
  */
  // Connection details
  require(...);
  try {
    $connection = new PDO("mysql:host=localhost;dbname=cs230a_ad", $mysql_user, $mysql_pw);
    $sql = file_get_contents("data/init.sql");
    $connection->exec($sql);

    echo "Database and table users created successfully.";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
