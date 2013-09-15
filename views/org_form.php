<?
include('../inc.php');
?>
<script type="text/javascript">
function submit_org_form() {
  emerge.ajax_post_form('ajax/org_post.php', 'org_form');
  $('#org').empty();
  emerge.ajax_get('views/select_org.php', 'org');
  $('#utilDialog').remove();
}
</script>
<p>
Add Organization name and description. You will not be able to modify the Organization after you submit this form. Be sure to spell everything correctly.
</p>
<form id="org_form">
  <table class="ods_table">
    <tr>
      <th>Organization Name</th>
      <td><input type="text" size="40" id="org_name" name="org_name"/></td>
    </tr>
    <tr>
      <th>Description</th>
      <td>
        <textarea id="org_desc" name="org_desc" rows="8" cols="40"></textarea>
      </td>
    </tr>
  </table>
  <button onClick="submit_org_form(); return false;">Add Oganization</button>
</form>
