<?
include('../inc.php');
$sql = new mysql();

$_GET = $sql->sanitizeArray($_GET);
$id = $_GET['id'];

$query = "SELECT * FROM dataSets WHERE id = '$id'";

$detail = $sql->getRows($query);
$detail = $detail[0];
?>
<strong>Type:&nbsp;</strong><?=$detail->link_type;?><br/>
<strong>Created On:&nbsp;</strong><?=$detail->created_date;?><br/>
<strong>Added By:&nbsp;</strong><?=$detail->suggested_by;?><br/>
<strong>Approved Date:&nbsp;</strong><?=$detail->approved_date;?><br/>
<strong>Tags:&nbsp;</strong>(<?=$detail->tags;?>)<br/>
<hr/>
<strong>Description:</strong><br/>
<div><? echo urldecode($detail->description);?></div>
