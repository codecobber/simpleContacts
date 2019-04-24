<?php

/*
Plugin Name: Simple Access
Description: Restrict user access for certain pages
Version: 1.0
Author: Code Cobber
Author URI: https://www.codecobber.co.uk/
*/



session_start();

// check user logged in
if(null !== get_cookie('GS_ADMIN_USERNAME')){
	 $userOnline = 1;
	 $_SESSION['userOnline'] = 1;
}
else{
	 $userOnline = 0;
	 $_SESSION['userOnline'] = 0;
}


# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile,				 # Plugin ID
	'SimpleContacts',  # Plugin name
	'1.0',						 # Plugin version
	'Code Cobber',		 # Plugin author
	'https://www.codecobber.co.uk/',  # author website
	'List contacts from file and allow search',  # Plugin description
	'simpleContacts',   # (dynamic) page type - on which admin tab to display
	'starter_show'		  # main plugin function to display content
);



//CONSTANTS
define("SCPLUGINSPATH","./plugins/");



# add a link in the admin tab 'simple_access'
# add_action( 'xxxxxx-sidebar', 'createSideMenu', array( 'your-plugin-filename', 'Menu Text', 'my-action' ) );
add_action('nav-tab', 'createNavTab', array( 'SimpleContacts', $thisfile, 'Simple Contacts','starter_show' ) );
add_action('simpleContacts-sidebar', 'createSideMenu', array($thisfile, 'About', 'about_sp'));
add_action( 'simpleContacts-sidebar', 'createSideMenu', array( $thisfile, 'Edit it', 'edit' ) );
add_action( 'simpleContacts-sidebar', 'createSideMenu', array( $thisfile, 'Show it', 'show' ) );
add_action( 'theme-header', 'addJSheader');
add_action( 'theme-footer', 'addJSfooter');

add_filter('content','content_test');


function addJSheader(){
	$jsHeaderScript = file_get_contents(SCPLUGINSPATH.'simpleContacts/simpleContacts.js') OR die();
	echo $jsHeaderScript;
}

function addJSfooter(){
	$jsFooterScript = file_get_contents(SCPLUGINSPATH.'simpleContacts/criteriaCheck.js') OR die();
	echo $jsFooterScript;
}


//Outputs different content according to page and placeholder
function content_test($con){


		// Grab the meta keywords
		$pageAddress = get_page_meta_keywords(FALSE);


		//check if keywords
		if(stripos($pageAddress, "editmeplugin") !== FALSE){
			$regex = '(%editme%)'; // this is what you need
			$out = "Found Ok this works - edit baby!!! SUPER AWESOME!!!!!";
		}
		elseif(stripos($pageAddress, "createmeplugin") !== FALSE){
			$regex = '(%createme%)'; // this is what you need
			$out = "Found Ok this works - Create baby!!! SUPER AWESOME!!!!!";
		}
		elseif(stripos($pageAddress, "helpmeplugin") !== FALSE){
			$regex = '(%helpme%)'; // this is what you need
			$out = "Found Ok this works - help baby!!! SUPER AWESOME!!!!!";
		}
		elseif(stripos($pageAddress, "contactsmeplugin") !== FALSE){
			$regex = '(%contactsme%)'; // this is what you need
			$out = file_get_contents(SCPLUGINSPATH.'simpleContacts/contactsSearch.php') or die();
		}

		//replace the placeholder with the new content
		$con = str_replace($regex, $out, $con);
		return $con;
}

function starter_show() {
//check for query string on backend admin
	if(isset($_GET['about_sp'])){
	  about_sp();
		echo $content;
		echo "<br>hello about us too";
	}


}




?>
