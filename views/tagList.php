<?
include('../inc.php');
$sql = new mysql();

$query = "
	SELECT tags
	FROM dataSets
";
$rows = $sql->getRows($query);
Dumper($rows);
