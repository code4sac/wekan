<?
include('lib/html/head.php');
?>
<!-- Main Menu 
================================================================ -->
<body>
<!-- Insert header here -->

<!-- End insert header -->
<!-- ============================================================== -->
<div id="maincontainer">
  <div id="contentwrapper">
	  <div id="contentcolumn">
	    <div id="main_container" class="innertube"></div>
	  </div><!-- /#contentcolumn -->
  </div><!-- /#contentWrapper -->
	
  <div id="left_col">
	<div id="left_container" class="innertube"></div>
    <div style="height: 24px; background-color: #141412; width: 100%;"></div>
    <div>
				<span>Search:</span> <input id="search_term" class="frm_input" type="text" />
    </div>
    <div class="left_menu">
      <ul>
        <li><a href="/">Data Portal</a></li>
		    <li><a href="#" onClick="javascript:loadMap();">GIS Maps</a></li>
		    <li><a href="#" onClick="javascript:showForm();">Suggest Data</a></li>
		    <li><a href="#" onClick="javascript:emerge.ajax_get('views/about.html', 'main_container');">About Data Portal</a></li>
		    <li><a href="#" onClick="javascript:emerge.ajax_get('views/help.html', 'main_container');">Help</a></li>
      </ul>
    </div>
    <div id="left_bottom"></div>
  </div><!-- /#leftColumn -->

  <div id="footer">By: Code for Sacramento</div>
</div><!-- /#maincontainer -->
</body>
</html>
