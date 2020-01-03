<?php

  // Connection details
  require(...);
  require "../common.php";

  /**
   * Use an HTML form to view more details for an entry in the
   * users table.
  */
  if (isset($_GET['id'])) {
    try {
      // Add dbname
      $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                                  \
      $connection->setAttribute(PDO::ATTR_PERSISTENT, false);
      $id = $_GET['id'];

      $sql = "SELECT * FROM items WHERE id = :id";
      $statement = $connection->prepare($sql);
      $statement->bindValue(':id', $id);
      $statement->execute();

      $item = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  } else {
    echo "Something went wrong!";
    exit;
  }
?>

<?php require "templates/header.php"; ?>
<h2>Item Details</h2>
<?php foreach ($item as $key => $value) :
    if ($value == $id){
      continue;
    }
  ?>
  <tr>
    <?php echo "<strong>"; ?>
    <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
    <?php echo "</strong>"; ?>
    <td><?php echo escape($value); ?></td>
  </tr>
<?php endforeach; ?>

<br><br><td><a href="update-single.php?id=<?php echo escape($item['id']); ?>">Edit Item</a></td>
<br><td><a href="delete.php?id=<?php echo escape($item['id']); ?>">Delete Item</a></td>
<br><br><td><a href="index.php">Back to Home</a></td>

<?php include "templates/footer.php"; ?>
