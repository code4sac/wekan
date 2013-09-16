<?
include('../inc.php');
$sql = new mysql();

$WHERE = NULL;

$_GET = $sql->sanitizeArray($_GET);

if(isset($_GET['search'])) {
	$search = $_GET['search'];
	if(isset($_GET['search'])) {
		$WHERE = "
		AND CONCAT(dataSets.link_type
				,	dataSets.author_name
				,	dataSets.approved_by
				,	dataSets.title
				,	dataSets.description
				,	dataSets.tags
			) LIKE '%$search%'
		";
	}
}
?>
<table class='data_table'>
<?
$query = "
	SELECT	dataSets.catID AS catID
		,	categories.category AS category
	FROM dataSets
	JOIN categories ON dataSets.catID = categories.id
	WHERE dataSets.id >= '0'
	$WHERE
	AND dataSets.suggested = '1'
	GROUP BY dataSets.catID
	ORDER BY dataSets.catID
";
$cats = $sql->getRows($query);
foreach($cats as $cat) {
	$catID = $cat->catID;
	$category = $cat->category;
	?>
	<tr><td class='catTitle' colspan="3"><?=$category;?></td></tr>
	<tr>
	  <th style="width: 110px;">Date Added</th>
	  <th>Resource Title</th>
	  <th style="width: 110px;">Format</th>
	</tr>
	<?
	$query = "
		SELECT	*
		FROM dataSets
		WHERE dataSets.id >= '0'
		AND dataSets.catID = '$catID'
		AND dataSets.suggested = '1'
		$WHERE
	";
	$rows = $sql->getRows($query);
	foreach($rows as $row) {
    $created_date = date('M jS Y', strtotime($row->created_date));
		$link = urldecode($row->link);
		?>
		  <tr>
			<td class="data_item"><?=$created_date;?></td>
			<td class="data_item">
			 <a href="#" onClick="genericDialog('<?=$row->title;?>', 'views/data_details.php?id=<?=$row->id;?>');"><?=$row->title;?></a>
			</td>
			<td class="data_item">
			  <a href="<?=$link;?>" target="_blank"><?=$row->link_type;?></a>
			</td>
		  </tr>
		<?
		
	}
}
?></table><?
?>

