<?
include('../inc.php');
$sql = new mysql();
$action = array('type' => 'insert', 'name' => 'Suggest Data');
$id = NULL;
if(isset($_GET['id'])) {
	$action = array('type' => 'update', 'name' => 'Update Data');
	$id = $_GET['id'];
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
	/* Make all info_help links clickable
   * ================================== */
	$('.info_help').each(function(index) {
		var alt = $(this).attr('alt');
		$(this).click(function() {
			var help_file = 'views/help/info_'+alt+'.html';
			emerge.ajax_get(help_file, 'left_container');
		});
	});
});
function updateHelp() {
	var link_type = $('#type').val().replace(/\s+/g, '_');
	var help_file = 'views/help/help_'+link_type+'.html';
	emerge.ajax_get(help_file, 'left_container');
}
function submit_data(type) {
	// Since I use serialize to gather up the data from the form, and tinyMCE does not return anything,
	// I jammed in a hidden field that temp holds the data.
	var ods_desc	= tinyMCE.activeEditor.getContent({format: 'raw'});
	$('#desc').val(ods_desc);
	// End tinyMCE hack

	var msg = emerge.ajax_post_form('/ajax/submit_data.php', 'suggest_form');
  console.log(msg);
	emerge.ajax_get('views/show_data.php', 'main_container');
//	$('#left_container').empty();
  alert(msg);
}

function newOrg() {
  //$('#org').empty();
  genericDialog('Add organization', 'views/org_form.php');
}

</script>
<form id="suggest_form">
  <table class="ods_table">
	  <tr>
		  <th>Your Name:</th>
		  <td>
        <input type="text" name="author_name" size="40" id="author_name" />
        <img class="info_help" alt="name" src="/views/img/info.png" />
      </td>
	  </tr>
	  <tr>
		  <th>Your Email:</th>
		  <td>
        <input type="text" name="author_email" size="40" id="author_email" />
        <img class="info_help" alt="name" src="/views/img/info.png" />
      </td>
	  </tr>
    <tr>
      <th>Organization</th>
      <td>
        <span id="org"></span>
        <button onClick="newOrg(); return false;">Add Organization</button>
      </td>
    </tr>
    <tr>
      <th>Original Source</th>
      <td><input type="text" name="orig_source" id="orig_source" size="40"/></td>
    </tr>
	  <tr>
      <th>Title:</th>
		  <td>
        <input type="text" name="title" size="60" id="title" />
        <img class="info_help" alt="title" src="/views/img/info.png" />
      </td>
	  </tr>
	  <tr>
		  <th>Link:</th>
		  <td>
        <input type="text" name="link" size="60" id="link" />
        <img class="info_help" alt="link" src="/views/img/info.png" />
      </td>
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
        <input type="hidden" name="map_data" value="0"/> <!-- checkbox val=0 hack -->
        <span>Contains Map Data? <input id="map_data" name="map_data" type="checkbox" value='1'/></span>
		  </td>
    </tr>
	  <tr>
      <th>Category:</th>
		  <td>
		  <?
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
		  <th>Description:</th>
		  <td>
        <textarea rows="10" cols="10" id="tmDesc" name="tmDesc"></textarea>
      </td>
    </tr>
	  <tr>
		  <th>Tags:</th>
		  <td>
        <input type="text" name="tags" size="40" id="tags" />
        <img class="info_help" alt="tags" src="/views/img/info.png" />
      </td>
    </tr>
    <tr>
      <th>Key / Value pairs</th>
      <td>
        <div>Key: <input type="text" /> = Value: <input type="text" /></div>
        <div>Key: <input type="text" /> = Value: <input type="text" /></div>
        <div>Key: <input type="text" /> = Value: <input type="text" /></div>
        <div>Key: <input type="text" /> = Value: <input type="text" /></div>
        <div>Key: <input type="text" /> = Value: <input type="text" /></div>
      </td>
    </tr>
    <tr>
		  <td>&nbsp;</td>
		  <td>
			  <button onClick="submit_data('<?=$action_type;?>'); return false;"><?=$action['name'];?></button>
			  <button onClick="emerge.ajax_get('views/show_data.php', 'main_content'); return false;">Cancel</button>
		  </td>
	  </tr>
  </table>
	<input type="hidden" name="action" value="<?=$action_type;?>" />
	<input type="hidden" name="id" value="<?=$id;?>" />
	<input type="hidden" id="desc" name="desc" value="" />
</form>
<script type="text/javascript">
  emerge.ajax_get('views/select_org.php', 'org');
</script>
