<?php

  /**
   * Use an HTML form to edit an entry in the
   * users table.
  */
  // Connection details
  require("/Users/classes/cs230a/students/cs230a-ad/mysql_config.php");
  require "../common.php";

  if (isset($_GET["id"])) {
    try {
      // Add dbname
      $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_PERSISTENT, false);

      $id = $_GET["id"];

      $sql = "DELETE FROM items WHERE id = :id";

      $statement = $connection->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();

      $success = "Item successfully deleted";
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if ($statement) { ?>
  <?php echo escape($success); ?> <br>
  <?php } ?>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
