<?
include('../inc.php');
$sql = new mysql();

$_GET = $sql->sanitizeArray($_GET);
$id = $_GET['id'];

$query = "
  SELECT  dataSets.*
      ,   categories.category AS category
      ,   organization.organization AS organization
  FROM dataSets
  LEFT JOIN categories ON
    dataSets.catID = categories.id
  LEFT JOIN organization ON
    dataSets.orgID = organization.id 
  WHERE dataSets.id = '$id'";

$detail = $sql->getRows($query);
$detail = $detail[0];
?>
<div class="innertube">
<h3><?=$detail->title;?></h3>
<strong>Organization:&nbsp;</strong><?=$detail->organization;?><br/>
<strong>Original Source:&nbsp;</strong><?=$detail->orig_source;?><br/>
<strong>Category:&nbsp;</strong><?=$detail->category;?><br/>
<br/>
<strong>Type:&nbsp;</strong><?=$detail->link_type;?><br/>
<strong>Map Data?:&nbsp;</strong><?=$detail->map_data;?><br/>
<strong>Tags:&nbsp;</strong>(<?=$detail->tags;?>)<br/>
<br/>
<strong>Added By:&nbsp;</strong><?=$detail->author_name;?><br/>
<strong>Created On:&nbsp;</strong><?=$detail->created_date;?><br/>
<strong>Approved Date:&nbsp;</strong><?=$detail->approved_date;?><br/>
<hr/>
<strong>Description:</strong><br/>
<div><? echo urldecode($detail->description);?></div>
<br/>
</div>
