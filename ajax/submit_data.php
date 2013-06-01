<?
include('../inc.php');
$sql = new mysql();

// Input Sanitize
$_POST = $sql->sanitizeArray($_POST);
$safe_input = $_POST;					// Reassign clean array.

$action = $safe_input['action'];
if(isset($safe_input['id'])) {
	$id = $safe_input['id'];
}

// Reassign for SQL.
$title		= $safe_input['title'];
$link		= $safe_input['link'];
$desc		= $safe_input['desc'];
$sugg_by	= $safe_input['sugg_by'];
$tags		= $safe_input['tags'];
$cat		= $safe_input['cat'];
$type		= $safe_input['type'];

if($action == 'insert') { // ============= INSERT ============================
    $query = "
		INSERT INTO dataSets VALUES('0',
			'$cat',
			'$type',
			NOW(),
			'0000-00-00 00:00:00',
			'$sugg_by',
			'NONE',
			'0',
			'$title',
			'$link',
			'$desc',
			'$tags'
  	);
    ";
    $sql = new mysql();
    $insID = $sql->insert($query);
	print "Thank you! For your reference, the data ID is: $insID";
} else if ($action == 'update') { // ======= UPDATE ==========================
	$query = "
		UPDATE	dataSets SET title = '$title'
			,	link	= '$link'
			,	description = '$desc'
			,	suggested_by = '$sugg_by'
			,	tags = '$tags'
			,	catID = '$cat'
			,	link_type = '$type'
		WHERE id = '$id'	
	";
	$sql->insert($query);
}
?>
