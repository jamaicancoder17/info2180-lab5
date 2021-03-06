<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

#$stmt = $conn->query("SELECT * FROM countries");

$country = $_GET["country"];
$context = $_GET["context"];
$flag = 0;

if ($context == "country"){
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE CONCAT('%',:country,'%')");
  $stmt->bindParam(':country',$country);
  $flag = 1;
}

elseif($context == "city"){
  $stmt1 = $conn->prepare("SELECT DISTINCT code FROM countries WHERE name LIKE CONCAT('%',:country,'%')");
  $stmt1->bindParam(':country',$country);
  $stmt1->execute();
  $temp = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  $hold = $temp[0]["code"];
  $stmt = $conn->prepare("SELECT name, district, population FROM cities WHERE country_code = ?");
  $stmt->bindValue(1,$hold);
  $flag = 2;
}

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if($flag == 1): ?>
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

<?php elseif($flag == 2): ?>
  <table>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
    
  <?php foreach ($results as $row): ?>
    <tr>
    <td><?= $row['name']?></td>
    <td><?= $row['district']?></td>
    <td><?= $row['population']?></td>
    </tr>
    <?php endforeach; ?>

  </table>
<?php endif;?>