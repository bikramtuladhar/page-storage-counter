<!DOCTYPE html>
<?php
session_start();
$_SESSION["ID"] = session_id();

$counter_name = "counter.txt";

if (!file_exists($counter_name)) {
  $f = fopen($counter_name, "w");
  fwrite($f,"0");
  fclose($f);
}

$f = fopen($counter_name,"r");
$datas = fread($f, filesize($counter_name));
fclose($f);

$datas = json_decode($datas, true);
if (!is_array($datas)) {
  $datas = [];
}
$count = $datas[$_SESSION["ID"]]['count']??0;
$datas[$_SESSION["ID"]]['count'] = ++$count;

$encodedData = json_encode($datas);
$f = fopen($counter_name, "w");
fwrite($f, $encodedData);
fclose($f);
?>

<body>
<?php
    echo "Your session id is: ".$_SESSION["ID"]."<br>";
    echo "You have visited this site: ".$count;
?>

</body>

</html>
