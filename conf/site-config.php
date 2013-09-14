<?
$site_config = array (
  'mysql' =>
    array (
      'host'  => 'localhost',
      'port'  => '3306',
      'user'  => 'root',
      'pass'  => '0cool',
      'db'    => 'wekan',
			'resType' => 'object',
			'result'=> false,
			'errors'=> true,
			'debug'	=> true
    ),
	'site' =>
		array (
      'title'   => 'WeKan',
			'wwwroot'	=> '',
			'root'		=> '/var/www/wekan',
			'lang'		=> 'en',
			'charset'	=> 'utf-8',
			'jquery'	=> true,
			'jquery_theme' => 'smoothness',
			'google_api'	=> false
		)
);
?>
