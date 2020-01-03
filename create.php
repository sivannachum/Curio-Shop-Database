<?php
/**
* Use an HTML form to create a new entry in the
* users table.
*
*/
if (isset($_POST['submit'])) {
    // credentials
    require(...);
    require "../common.php";
    try {
      $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_PERSISTENT, false);
      $new_item = array(
        "itemname" => $_POST['itemname'],
        "description" => $_POST['description'],
        "dateacquired" => $_POST['dateacquired'],
        "price" => $_POST['price'],
      );
      $sql = sprintf(
        "INSERT INTO %s (%s) values (%s)",
        "items",
        implode(", ", array_keys($new_item)),
        ":" . implode(", :", array_keys($new_item))
      );
      $statement = $connection->prepare($sql);
      $statementWorked = $statement->execute($new_item);
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statementWorked) { ?>
    <blockquote><?php echo $_POST['itemname']; ?> successfully added.</blockquote>
    <?php } ?>
    
<h2>Add an item</h2>
<form method="post">
    <label for="itemname">Item Name</label>
      <input type="text" name="itemname" id="itemname">
    <label for="description">Description</label>
      <input type="text" name="description" id="description">
    <label for="dateacquired">Date Acquired (YYYY-MM-DD)</label>
      <input type="text" name="dateacquired" id="dateacquired">
    <label for="price">Price</label>
      <input type="text" name="price" id="price">
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
