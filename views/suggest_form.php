<?
include('../inc.php');
$action = array('type' => 'insert', 'name' => 'Suggest Data');
$id = NULL;
if(isset($_GET['id'])) {
	$action = array('type' => 'update', 'name' => 'Update Data');
	$id = $_GET['id'];
	$sql = new mysql();
	$query = "SELECT * FROM dataSets WHERE id='$id'";
	$row = $sql->getRows($query);
	$row = $row[0];
	?>
	<script>
	$(function() {
	  tinymce.init({
		menubar: false,
		rows: '5',
		cols: '2',
		selector: "textarea"
	  });
	
	 setTimeout(function() {
	  $('#title').val('<?=$row->title;?>');
	  tinyMCE.activeEditor.setContent('<?=$row->description;?>', {format: 'raw'});
	  $('#link').val('<?=$row->link;?>');
	  $('#tags').val('<?=$row->tags;?>');
	  $('#sugg_by').val('<?=$row->suggested_by;?>');
	  $('#cat').val('<?=$row->catID;?>');
	  $('#type').val('<?=$row->link_type;?>');
	 }, '500');
	});
	</script>
	<?
}
$action_type = $action['type'];
?>
<script>
$(function() {
	// Make all info_help links clickable
	$('.info_help').each(function(index) {
		var alt = $(this).attr('alt');
		$(this).click(function() {
			var help_file = 'views/help/info_'+alt+'.html';
			ajaxGET(help_file, 'left_container');
		});
	});
});
function updateHelp() {
	var link_type = $('#type').val().replace(/\s+/g, '_');
	var help_file = 'views/help/help_'+link_type+'.html';
	ajaxGET(help_file, 'left_container');
}
function submit_data(type) {
	// Since I use serialize to gather up the data from the form, and tinyMCE does not return anything,
	// I jammed in a hidden field that temp holds the data.
	var ods_desc	= tinyMCE.activeEditor.getContent({format: 'raw'});
	$('#desc').val(ods_desc);
	// End tinyMCE hack

	var msg = ajaxFormPOST('/data/ajax/submit_data.php', '#suggest_form');
	ajaxGET('/data/views/show_data.php', 'main_container');
	$('#left_container').empty();
	alert("Thank you for the submission! Check back soon, we are monitoring for approvals");
}

</script>
	<form id="suggest_form">
	  <table class="ods_table">
	   <tr>
		<th>Title:</th>
		<td><input type="text" name="title" size="60" id="title" /><img class="info_help" alt="title" src="/data/views/img/info.png" /></td>
	   </tr>
	   <tr>
		<th>Link:</th>
		<td><input type="text" name="link" size="60" id="link" /><img class="info_help" alt="link" src="/data/views/img/info.png" /></td>
	   </tr>
	   <tr>
		<th>Link Type:</th>
		<td>
		  <select name="type" onChange="updateHelp();" id="type">
			<option SELECTED>Choose Type...</option>
			<option value="Link to Source">Link to Source</option>
			<option value="PDF">PDF</option>
			<option value="Fusion Table">Fusion Table</option>
		  </select>
		</td>
	   </tr>
	   <tr>
		<th>Description:</th>
		<td><textarea rows="6" cols="10" id="tmDesc" name="tmDesc"></textarea></td>
	   </tr>
	   <tr>
		<th>Category:</th>
		<td>
		<?
		$sql = new mysql();
		$query = "SELECT * FROM categories";
		$rows = $sql->getRows($query);;
		?>
		<select id="cat" name="cat">
		<option>Select a category</option>
		<?
		foreach($rows as $cat) {
		  ?><OPTION value='<?=$cat->id;?>'><?=$cat->category;?></option><?
		}
		?>
		</select>
		</td>
	   </tr>
	   <tr>
		<th>Tags:</th>
		<td><input type="text" name="tags" size="40" id="tags" /><img class="info_help" alt="tags" src="/data/views/img/info.png" /></td>
	   </tr>
	   <tr>
		<th>Your Name:</th>
		<td><input type="text" name="sugg_by" size="40" id="sugg_by" /><img class="info_help" alt="name" src="/data/views/img/info.png" /></td>
	   </tr>
		<tr><td colspan="2"><h4>Optional Information</h4></td></tr>
		<td>&nbsp;</td>
		<td>
			<button onClick="submit_data('<?=$action_type;?>'); return false;"><?=$action['name'];?></button>
			<button onClick="ajaxGET('views/show_data.php', 'main_content'); return false;">Cancel</button>
		</td>
	   </tr>
	  </table>
		<input type="hidden" name="action" value="<?=$action_type;?>" />
		<input type="hidden" name="id" value="<?=$id;?>" />
		<input type="hidden" id="desc" name="desc" value="" />
	</form>
