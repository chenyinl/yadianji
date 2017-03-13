<?php
// ATN Product Lister 
// Copyright (c) All Rights Reserved, ATN Solutions 2003-2016
// Check http://www.atnsolutions.com/product-lister for demos and information
// Released under the MIT license
?><?php
if(!defined('IN_SCRIPT')) die("");

if(isset($_REQUEST["id"]))
{
	$id=intval($_REQUEST["id"]);
	$this->ms_i($id);
}
else
{
	die("The listing ID isn't set.");
}


$listings = simplexml_load_file($this->data_file);


?>
<script>
function GoBack()
{
	history.back();
}
</script>
<br/>
<a id="go_back_button" class="btn btn-default btn-xs pull-right" href="javascript:GoBack()"><?php echo $this->texts["go_back"];?></a>

<h2><?php echo $listings->listing[$id]->title;?></h2>
<?php
$this->Title($listings->listing[$id]->title);
$this->MetaDescription($listings->listing[$id]->description);
?>
<hr/>
<div class="row">
	<?php
	if($listings->listing[$id]->images=="")
	{
		?>
		<div class="col-md-12">
		<?php
	}
	else
	{
		?>
		<div class="col-md-7">
		<?php
		
	}
	
	?>
		
		<?php echo $listings->listing[$id]->description;?>
		<br/><br/>
		
		<?php
		if(trim($listings->listing[$id]->price)!="")
		{
		?>
	
			<?php echo $this->texts["price"];?>: 
			<strong><?php echo $this->settings["website"]["currency"].$listings->listing[$id]->price;?></strong>
		<?php
		}
		?>
        <br/>
	    <?php echo $this->texts["sku"];?>: <strong><?php echo $listings->listing[$id]->sku;?></strong>
	
	</div>
	<?php
	if($listings->listing[$id]->images!="")
	{
		/// showing the listing images
		?>
		<div class="col-md-5">
			<?php
				$images=explode(",",trim($listings->listing[$id]->images,","));
					
				echo "<a href=\"uploaded_images/".$images[0].".jpg\" rel=\"prettyPhoto[ad_gal]\">";
				echo "<img src=\"uploaded_images/".$images[0].".jpg\" alt=\"".$listings->listing[$id]->title."\" class=\"final-image\"/>";
				echo "</a>";
				?>
				
				<br/><br/>
				<?php
					
				for($i=(sizeof($images)-1);$i>=1;$i--)
				{
					if(trim($images[$i])=="") continue;
					
					if($i!=0)
					{
						echo "<a href=\"uploaded_images/".$images[$i].".jpg\" rel=\"prettyPhoto[ad_gal]\">";
					}
					echo "<img src=\"thumbnails/".$images[$i].".jpg\" width=\"78\" alt=\"\"/>";
					if($i!=0)
					{
						echo "</a>";
					}
				}
				?>
				<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
				<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
				<script type="text/javascript" charset="utf-8">
				$(document).ready(function()
				{
					$("a[rel='prettyPhoto[ad_gal]']").prettyPhoto({

					});
				});
				</script>
		
		</div>
		<?php
		/// end showing the listing images
	}
	?>



</div>
