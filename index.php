<?
include('lib/html/head.php');
?>
<!-- Main Menu 
================================================================ -->
<body>
    <div id="topsection">
      <div class="innertube">
		<span style="position: absolute; top: 3px; left: 50px;">
		<a href="/data">
		<img src="views/img/ods-logo.png" />
		</a>
		</span>
		<span style="float: right; margin-top: 10px; margin-right: 10px;">
				<span style="">Search:</span> 
				<input id="search_term" class="frm_input" type="text" />
		</span>
	  </div>
    </div><!-- /#topsection -->
<!-- ============================================================ -->
	<div id="nav_menu">
	  <ul>
		<li><a href="/">CfS Home</a></li>
		<li><a href="#" onClick="javascript:showForm();">Suggest Data</a></li>
		<li><a href="#" onClick="javascript:emerge.ajax_get('views/about.html', 'main_container');">About</a></li>
		<li><a href="#" onClick="javascript:emerge.ajax_get('views/help.html', 'main_container');">Help</a></li>
	  </ul>
	</div>
<!-- ============================================================== -->
<div id="maincontainer">
  <div id="contentwrapper">
	<div id="contentcolumn">
	  <div id="main_container" class="innertube"></div>
	</div><!-- /#contentcolumn -->
  </div><!-- /#contentWrapper -->
	
  <div id="left_col">
	<div id="left_container" class="innertube"></div>
  </div><!-- /#leftColumn -->

  <div id="footer">By: Code for Sacramento</div>
</div><!-- /#maincontainer -->
</body>
</html>
