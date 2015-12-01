<?php

class Main extends CI_Controller {

	public function index()
	{
		$str = "<h3>Ceazer</h3>";
		echo $str;
		echo "<br/>";
        //echo CI_VERSION;
		echo "<a href='".base_url('user').">User Panel Link</a>";
		//echo phpinfo();
	}
}