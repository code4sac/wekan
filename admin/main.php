<? $key = 'hak4sac'; ?>
<script type="text/javascript">
function approve_item(id) {
	var aStat = $('#approve-'+id).html();
	if(aStat == 'Reject') {
		// Do Reject
		updateOneField('dataSets', id, 'suggested', '0');
		ajaxGET('main.php', 'main_container');
	} else if (aStat == 'Approve') {
		// Do Approve
		updateOneField('dataSets', id, 'suggested', '1');
		updateOneField('dataSets', id, 'approved_date', 'NOW()');
		ajaxGET('main.php', 'main_container');
	}
}
function edit_item(id) {
	genericDialog('Edit Form', '../views/suggest_form.php?id='+id);
}
function del_item(id) {
	$('#dialog_confirm').dialog({
		resizable: false,
		height: 140,
		modal: true,
		buttons: {
		  "Yes": function() {
			deleteRow('dataSets', id);
			ajaxGET('main.php', 'main_container');
			$(this).dialog("close");
		  },
		  "No": function() {
			$(this).dialog("close");
		  }
		}
	});
	
}

</script>
<div id="dialog_confirm" style="display: none;">
Are you sure you want to do this?
</div>
<?
include('../inc.php');
$sql = new mysql();
$WHERE = NULL;
if(isset($_GET['search'])) {
	$search = $_GET['search'];
	$WHERE = "
		AND CONCAT(dataSets.link_type
				,	dataSets.suggested_by
				,	dataSets.approved_by
				,	dataSets.title
				,	dataSets.description
				,	dataSets.tags
			) LIKE '%$search%'
	";
}
?>
<h2>Admin Tools</h2>
<table class='data_table'>
<?
$query = "
	SELECT	dataSets.catID AS catID
		,	categories.category AS category
	FROM dataSets
	JOIN categories ON dataSets.catID = categories.id
	WHERE dataSets.id >= '0'
	$WHERE
	GROUP BY dataSets.catID
	ORDER BY dataSets.catID
";
$cats = $sql->getRows($query);
foreach($cats as $cat) {
	$catID = $cat->catID;
	$category = $cat->category;
	?>
	<tr><td class='catTitle' colspan="4"><?=$category;?></td></tr>
	<tr>
	  <th style="width: 110px;">Date Added</th>
	  <th>Resource Title</th>
	  <th style="width: 110px;">Format</th>
	  <th>Tools</th>
	</tr>
	<?
	$query = "
		SELECT	*
		FROM dataSets
		WHERE dataSets.id >= '0'
		AND dataSets.catID = '$catID'
		$WHERE
	";
	$rows = $sql->getRows($query);
	foreach($rows as $row) {
		$date = date('M nS, Y', strtotime($row->created_date));
		?>
		  <tr>
			<td class="data_item"><?=$date;?></td>
			<td class="data_item">
			 <a href="#" onClick="genericDialog('<?=$row->title;?>', '../views/data_details.php?id=<?=$row->id;?>');"><?=$row->title;?></a>
			</td>
			<td class="data_item">
			  <a href="<?=$row->link;?>" target="_blank"><?=$row->link_type;?></a>
			</td>
			<td class="data_item" style="border-left: 1px solid #000; text-align: center;">
			  <?
				if($row->suggested == 1) {
					$approve_label = "Reject";
				} else if($row->suggested == 0) {
					$approve_label = "Approve";
				}
			  ?>
			  <a id="approve-<?=$row->id;?>" href="#" onClick="approve_item('<?=$row->id;?>');"><?=$approve_label;?></a> | 
			  <a href="#" onClick="edit_item('<?=$row->id;?>');">Edit</a> | 
			  <a href="#" onClick="del_item('<?=$row->id;?>');">del</a> 
			</td>
		  </tr>
		<?
		
	}
}
?></table><?
?>

