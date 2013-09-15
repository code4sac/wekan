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
  'mail' =>
    array (
      'smtp_host'   => 'smtp.gmail.com',
      'smtp_port'   => '465',
      'mail_from'   => 'kaleb@codeforsacramento.org'
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
      'api_key' => 'AIzaSyAJsXs9HHywzBcR_JSfcgQeWmrEyaPu28c',
			'google_api'	=> false
		)
);
?>
