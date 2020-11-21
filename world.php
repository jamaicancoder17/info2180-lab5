<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

#$stmt = $conn->query("SELECT * FROM countries");
$stmt1 = $conn->prepare("SELECT * FROM countries WHERE name LIKE CONCAT('%',:country,'%')");
$country = $_GET["country"];
$stmt1->bindParam(':country',$country);
$stmt1->execute();
$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);

?>
<table>
  <th>Name</th>
  <th>Continent</th>
  <th>Independence</th>
  <th>Head of State</th>
  
<?php foreach ($results as $row): ?>
  <tr>
  <td><?= $row['name']?></td>
  <td><?= $row['continent']?></td>
  <td><?= $row['independence_year']?></td>
  <td><?= $row['head_of_state']?></td>
  </tr>
  <?php endforeach; ?>

</table>
