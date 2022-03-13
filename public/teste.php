<?

//header("Content-Type: application/json; charset=UTF-8");
//echo json_encode(array('casa' => 'teste', 'nome' => 'ca'));

$conn = new PDO('mysql:host=34.148.53.153:3306;dbname=match', 'root', 'ZmQp!#@$00');
$result = $conn->prepare('SELECT * FROM user WHERE user_id = ? ');
$result->execute(array(1));

$posts = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo 3;
    $posts[] = $row;
    print_r($row);
}


?>