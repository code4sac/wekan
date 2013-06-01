<?
include('../inc.php');
print "<h2>You have found the development version of the Code for Sacramento Data Portal.</h2>";
print "<h3>You will have better luck on the main website <a href='http://www.codeforsacramento.org/data'>Here</a>. In fact, we suggest you use that one.</h3>";
$sql = new mysql();

$WHERE = NULL;

$_GET = $sql->sanitizeArray($_GET);

if(isset($_GET['search'])) {
	$search = $_GET['search'];
	if(isset($_GET['search'])) {
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
		$date = date('M nS, Y', strtotime($row->created_date));
		$link = urldecode($row->link);
		?>
		  <tr>
			<td class="data_item"><?=$date;?></td>
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

