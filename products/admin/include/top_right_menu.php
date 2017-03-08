<?php
// ATN Product Lister All Rights Reserved
// A software product of ATN Solutions, All Rights Reserved
// Find out more about our products and services on:
// http://www.atnsolutions.com
// Released under the MIT license
?><?php
if(!isset($_COOKIE["AuthUser"])) 
{
?>

	<a target="_blank" href="http://www.atnsolutions.com/en_Contact.html" class="top-right-link"><img src="images/contact.png"/>
	<?php echo $this->texts["have_questions"];?>
	</a>
<?php
}
else
{
?>
	<a target="_blank" href="../index.php" class="top-right-link underline-link">
	
	<?php echo $this->texts["open_main_site"];?>
	</a> 
	<a href="index.php?page=settings" class="top-right-link"><img src="images/settings.png"/>
	<?php echo $this->texts["settings"];?>
	</a> 
	<a href="logout.php" class="top-right-link"><img src="images/logout.png"/>
	<?php echo $this->texts["logout"];?>
	</a>

<?php
}
?>
