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
    <div>
				<span>Search:</span> <input id="search_term" class="frm_input" type="text" />
    </div>
    <div class="left_menu">
      <ul>
		    <li><a href="/">CfS Home</a></li>
		    <li><a href="#" onClick="javascript:showForm();">Suggest Data</a></li>
		    <li><a href="#" onClick="javascript:emerge.ajax_get('views/about.html', 'main_container');">About</a></li>
		    <li><a href="#" onClick="javascript:emerge.ajax_get('views/help.html', 'main_container');">Help</a></li>
      </ul>
    </div>
  </div><!-- /#leftColumn -->

  <div id="footer">By: Code for Sacramento</div>
</div><!-- /#maincontainer -->
</body>
</html>
