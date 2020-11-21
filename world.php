<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

#$stmt = $conn->query("SELECT * FROM countries");
$stmt1 = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
$country = $_GET["country"];
$stmt1->bindParam(':country',$country);
$stmt1->execute();
$results = $stmt1->fetchAll(PDO::FETCH_ASSOC);

?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
