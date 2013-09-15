<?
include('../inc.php');
$sql = new mysql();
?>
<select name="organization" id="organization">
  <OPTION value="NULL">Select organization...</option>
  <?
  $query = "SELECT * FROM organization ORDER BY organization";
  $rows  = $sql->getRows($query); 
  foreach($rows as $row) {
    ?><OPTION value="<?=$row->id;?>"><?=$row->organization;?></option><?
  }
  ?>
</select>
