<?php
  
  // Connection details
  require(...);
  require "../common.php";

  if (isset($_POST['submit'])) {
    try {
      // Add dbname
      $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $connection->setAttribute(PDO::ATTR_PERSISTENT, false);
      $item =[
        "itemname" => $_POST['itemname'],
        "description" => $_POST['description'],
        "dateacquired" => $_POST['dateacquired'],
        "price" => $_POST['price'],
        "id" => $_GET['id']
      ];
      
      $sql = "UPDATE items
              SET
              itemname = :itemname,
              description = :description,
              dateacquired = :dateacquired,
              price = :price
              WHERE id = :id";
              
      $statement = $connection->prepare($sql);
      $statementWorked = $statement->execute($item);
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }

  /**
   * Use an HTML form to edit an entry in the
   * users table.
  */
  if (isset($_GET['id'])) {
    try {
      // Add dbname
      $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

<?php if (isset($_POST['submit']) && $statementWorked) : ?>
  <?php echo escape($_POST['itemname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit this item</h2>

<form method="post">
    <?php foreach ($item as $key => $value) :
        if ($value == $id){
          continue;
        }
      ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
  <input type="submit" name="submit" value="Submit">
</form>

<ul>
  <td><a href="delete.php?id=<?php echo escape($id); ?>">Delete</a> - delete this item</td>
</ul>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
