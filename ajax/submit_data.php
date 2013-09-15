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
$author_name  = filter_var($safe_input['author_name'], FILTER_SANITIZE_STRING);
$author_email = filter_var($safe_input['author_email'], FILTER_SANITIZE_EMAIL);
$org          = filter_var($safe_input['organization'], FILTER_VALIDATE_INT);
$orig_source  = filter_var($safe_input['orig_source'], FILTER_SANITIZE_URL);
$title    		= filter_var($safe_input['title'], FILTER_SANITIZE_STRING);
$link		      = filter_var($safe_input['link'], FILTER_SANITIZE_URL);
$type	    	  = filter_var($safe_input['type'], FILTER_SANITIZE_STRING);
$map_data     = filter_var($safe_input['map_data'], FILTER_VALIDATE_BOOLEAN);
$cat	    	  = filter_var($safe_input['cat'], FILTER_VALIDATE_INT);
$desc		      = $safe_input['desc'];
$tags		      = filter_var($safe_input['tags'], FILTER_SANITIZE_STRING);

if($action == 'insert') { // ============= INSERT ============================
    $query = "
		INSERT INTO dataSets VALUES('0',
			'$cat',
      '$org',
			'$type',
      '$map_data',
			NOW(),
			'0000-00-00 00:00:00',
			'$author_name',
      '$author_email',
			'NONE',
			'0',
			'$title',
      '$orig_source',
			'$link',
			'$desc',
			'$tags'
  	);
    ";
    $sql = new mysql();
    $insID = $sql->insert($query);
    mail('kaleb@codeforsacramento.org', 'WeKAN data suggestion', 'New data has been added. id=$insID');
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
