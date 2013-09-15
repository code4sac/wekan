<?
include('../inc.php');
$sql = new mysql();

$query = "
  SELECT  id
      ,   title
      ,   link
  FROM dataSets
  WHERE link_type = 'Fusion Table'
  AND map_data = '1'
";
$rows = $sql->getRows($query);
?>
<script type="text/javascript">
var layers = new Array();
var gLayers = {};
</script>
<div id="map-layers">
  <select id="map_layer_select">
    <?
    foreach($rows as $row) {
      preg_match('/docid=(.*)/', urldecode($row->link), $match);
      if(isset($match[1])) {
        $row->title = "Hidden - ".$row->title;
        ?>
        <script type="text/javascript">
          /* Set all layers to false
           * ======================= */
          layers['<?=$match[1];?>'] = false;

        </script>
        <option value="<?=$match[1];?>"><?=$row->title;?></option>
        <?
      }
    }

    ?>
  </select>
  <button id='layer_button' onClick="show_hide_layer();">Show</button>
  <button onClick="hide_all_layers();">Hide All Layers</button>

</div>

<script type="text/javascript">
var map;
var sacramento = new google.maps.LatLng(38.579016, -121.482753);

map = new google.maps.Map(document.getElementById('map-canvas'), {
  center: sacramento,
  zoom: 11,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

function add_layer(ft_id) {
  var title = $('#map_layer_select option:selected').text();
  console.log('add - '+ft_id);
    $('#layer_button').html('Hide');
    var new_title = title.replace('Hidden', 'Visible');
    $('#map_layer_select option:selected').text(new_title);
  gLayers[ft_id] = new google.maps.FusionTablesLayer({
    query: {
      select: '\'Geocodable address\'',
      from: ft_id
    }
  });
  gLayers[ft_id].setMap(map);
}

function remove_layer(ft_id) {
  var title = $('#map_layer_select option:selected').text();
    $('#layer_button').html('Show');
    var new_title = title.replace('Visible', 'Hidden');
    $('#map_layer_select option:selected').text(new_title);
  gLayers[ft_id].setMap(null);
  delete gLayers[ft_id];
  console.log('remove');
}

function show_hide_layer() {
  var ft_id = $('#map_layer_select option:selected').val();
  //if(layers[ft_id] == false) {
    if(typeof gLayers[ft_id] !== 'undefined') {
    layers[ft_id] = true;

    add_layer(ft_id);
  } else {
    layers[ft_id] = false;
    remove_layer(ft_id);
  }
}

function hide_all_layers() {
  console.log('hide all layers');
  jQuery.each(gLayers, function(index, item) {
    console.log(index);
    remove_layer(index);
  });
  $('#map_layer_select > option').each(function() {
    var title = this.text;
    title.replace('Visible', 'Hidden');
    console.log(this.text);
    $(this).text(title);
  });
}



$('#map_layer_select').change(function() {
  var ft_id = $('#map_layer_select option:selected').val();
  if(layers[ft_id] == true) {
    $('#layer_button').html('Hide');
  } else {
    $('#layer_button').html('Show');
  }
/*
  var ft_id = $('#map_layer_select option:selected').val();
      layer = new google.maps.FusionTablesLayer({
        query: {
          select: '\'Geocodable address\'',
          from: ft_id
        }
      });
      layer.setMap(map);
*/
});

//function initialize() {

//}

//google.maps.event.addDomListener(window, 'load', initialize);

</script>

<div id="map-canvas"/>
<?
function ident_ft_type($ft_id) {
  global $site_config;
  $google_ft_url = "https://www.googleapis.com/fusiontables/v1/tables/";
  $keystring = "&key=".$site_config['site']['api_key'];
  $request = $google_ft_url.$ft_id.$keystring;
  print $request."<br/>";
  //$json = file_get_contents($request);
  //Dumper(json_decode($json));
}
?>
