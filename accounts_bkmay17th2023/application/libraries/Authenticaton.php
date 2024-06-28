<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticaton
{
     public function is_logged_in()
     {
			 $user = $_SESSION['glassco_accounts_username'];
			 return isset($user); 
     }
	 
}
?>