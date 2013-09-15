<?
include('../inc.php');
$sql = new mysql();
?>
<script type="text/javascript">
var gLayers = {};
</script>

<script type="text/javascript">
var map;
var sacramento = new google.maps.LatLng(38.579016, -121.482753);

map = new google.maps.Map(document.getElementById('map-canvas'), {
  center: sacramento,
  zoom: 11,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});


function toggle_layer(ft_id, id) {
  console.log('toggle: '+ft_id);
  if(typeof gLayers[ft_id] == 'undefined') {
    console.log('Layer NOT present');
    gLayers[ft_id] = new google.maps.FusionTablesLayer({
      query: {
        select: '\'Geocodable address\'',
        from: ft_id
      },
      styleId: 2
      
    });
    gLayers[ft_id].setMap(map);
    $('#'+ft_id+' a').css('background-color', '#EEE');
    emerge.ajax_get('views/data_details.php?id='+id, 'layer_detail');
  } else {
    console.log('Layer IS present');
    gLayers[ft_id].setMap(null);
    delete gLayers[ft_id];
    $('#'+ft_id+' a').css('background-color', '#FFF');
    $('#layer_detail').empty();
  }
}

</script>

<div id="map-canvas"/>
<div id="layer_detail"/>
