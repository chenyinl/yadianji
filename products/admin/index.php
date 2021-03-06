<?php
// ATN Product Lister, http://www.atnsolutions.com/product-lister
// A software product of ATN Solutions, All Rights Reserved
// Find out more about our products and services on:
// http://www.atnsolutions.com
// Released under the MIT license
?><?php
include("check_user.php");
define("IN_SCRIPT","1");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
 
include("../include/SiteManager.class.php");

$website = new SiteManager();
$website->SetDataFile("../data/listings.xml");
$website->LoadSettings();

$website->LoadTemplate();

if(isset($_REQUEST["page"]))
{
	$website->check_word($_REQUEST["page"]);
	$website->SetPage($_REQUEST["page"]);
}
else
{
	$website->SetPage("home");
}

$website->Render();

?>
