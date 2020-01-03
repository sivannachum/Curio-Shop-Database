<?php include "templates/header.php"; ?>

<ul>
  <li><a href="create.php"><strong>Add</strong></a> - add an item</li>
  <li><a href="read.php"><strong>Search</strong></a> - search for an item</li>
</ul>

<?php

  /**
  * List all items with a link to edit
  */
  try {
    // Connection details
    require(...);
    require "../common.php";
    // Add dbname
    $connection = new PDO("mysql:host=localhost;dbname=...",$mysql_user,$mysql_pw);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_PERSISTENT, false);

    $sql = "SELECT * FROM items ORDER BY price DESC";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();                                                                            
  }
?>

<h2>Available Items</h2>
<table>
  <thead>
    <tr>
      <th>Item Name</th>
      <th>Price</th>
      <th>Acquisition Date</th>
      <th>More Details</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["itemname"]); ?></td>
        <td><?php echo escape($row["price"]); ?></td>
        <td><?php echo escape($row["dateacquired"]); ?></td>
        <td><a href="more-details.php?id=<?php echo escape($row["id"]); ?>">More Details</a></td\>                                                                                                                                                                                                                                          \
      </tr>
    <?php endforeach; ?>                                                                                                                                                                                        \
   </tbody>
</table>

<?php include "templates/footer.php"; ?>
