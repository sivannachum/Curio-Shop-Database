<?php
  /**
   * Function to query information based on
   * a parameter: in this case, location.
  */
  if (isset($_POST['submit'])) {
    try  {
      // Connection details
      require(...);
      require "../common.php";
                        
      $connection = new PDO("mysql:host=localhost;dbname=cs230a_ad",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_PERSISTENT, false);
      
      $sql = "SELECT * FROM items
             WHERE itemname LIKE concat('%',:itemname,'%')";
      $itemname = $_POST['itemname'];
      $statement = $connection->prepare($sql);
      $statement->bindParam(':itemname', $itemname, PDO::PARAM_STR);
      $statement->execute();
      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }
?>

<?php require "templates/header.php"; ?>
<?php
  if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
      <h2>Results</h2>
      <table>
        <thead>
          <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Date Acquired</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $row) { ?>
            <tr>
              <td><?php echo escape($row["itemname"]); ?></td>
              <td><?php echo escape($row["description"]); ?></td>
              <td><?php echo escape($row["dateacquired"]); ?></td>
              <td><?php echo escape($row["price"]); ?></td>                                                        \
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <blockquote>No results found for <?php echo escape($_POST['itemname']); ?>.</blockquote>
      <?php }
    } ?>

<h2>Find item based on its name</h2>
<form method="post">
    <label for="itemname">Item Name</label>
    <input type="text" id="itemname" name="itemname">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
