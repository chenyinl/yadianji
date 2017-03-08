<?php
// ATN Product Lister
// http://www.atnsolutions.com/product-lister
// Copyright (c) All Rights Reserved ATN Solutions
// Find out more about our products and services on:
// http://www.atnsolutions.com
// Released under the MIT license
?><?php
if(!defined('IN_SCRIPT')) die("");

$id=intval($_REQUEST["id"]);

$this->ms_i($id);

?>
	<div class="header-line">
		  <div class="container">
		  
			<a href="index.php" style="margin-top:17px" class="btn btn-default pull-right">Go Back</a>
			
			<h3><?php echo $this->texts["edit_listing"];?></h3>
		  </div>
	</div>
	<script>
$(function(){
	var offsetX = 20;
	var offsetY = -200;
	$('a.hover').hover(function(e){	
		var href = $(this).attr('href');
		$('<img id="largeImage" src="' + href + '" alt="image" />')
			.css({'top':e.pageY + offsetY,'left':e.pageX + offsetX})
			.appendTo('body');
	}, function(){
		$('#largeImage').remove();
	});
	$('a.hover').mousemove(function(e){
		$('#largeImage').css({'top':e.pageY + offsetY,'left':e.pageX + offsetX});
	});
	$('a.hover').click(function(e){
		e.preventDefault();
	});
});
</script>
	

	<div class="container">

			<br/>
			<?php

			
			$xml = simplexml_load_file($this->data_file);

		
			if(isset($_POST["proceed_save"]))
			{
				$xml->listing[$id]->description=stripslashes($_POST["description"]);
				$xml->listing[$id]->title=stripslashes($_POST["title"]);
                $xml->listing[$id]->cost=stripslashes($_POST["cost"]);
				$xml->listing[$id]->price=stripslashes($_POST["price"]);
				$xml->listing[$id]->brand=stripslashes($_POST["brand"]);
				$xml->asXML($this->data_file); 
				echo "<h3>".$this->texts["modifications_saved"]."</h3><br/>";
			}	
			
			

			
			?>
			
			<div class="row">
				<div class="col-md-8">
				
					<br/>
				
				
					<form id="main" action="index.php" method="post"   enctype="multipart/form-data">
					<input type="hidden" name="page" value="edit"/>
					<input type="hidden" name="proceed_save" value="1"/>
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					
						<fieldset>
							<legend><?php echo $this->texts["listing_details"];?></legend>
							<ol>
								<li>
									<label><?php echo $this->texts["title"];?>:</label>
									
									<input type="text" name="title" required value="<?php echo $xml->listing[$id]->title;?>"/>
								</li>
								<li>
									<label><?php echo $this->texts["description"];?>:</label>
									
									<textarea name="description" cols="40" rows="10"><?php echo $xml->listing[$id]->description;?></textarea>
								</li>
                                <li>
									<label><?php echo $this->texts["cost"];?> (<?php echo $this->settings["website"]["currency"];?>):</label>
									
									<input type="text" name="cost" value="<?php echo $xml->listing[$id]->cost;?>"/>
								</li>
                                <li>
									<label><?php echo $this->texts["brand"];?>:</label>
									
									<input type="text" name="brand" value="<?php echo $xml->listing[$id]->brand;?>"/>
								</li>
								<li>
									<label><?php echo $this->texts["price"];?> (<?php echo $this->settings["website"]["currency"];?>):</label>
									
									<input type="text" name="price" value="<?php echo $xml->listing[$id]->price;?>"/>
								</li>
							<ol>
						</fieldset>
						
						<fieldset id="images_fieldset">
							<legend><?php echo $this->texts["images"];?></legend>
							
								<?php
								if(trim($xml->listing[$id]->images)!="")
								{
									$image_ids = explode(",",trim($xml->listing[$id]->images));
				
									foreach($image_ids as $image_id)
									{
										if(file_exists("../thumbnails/".$image_id.".jpg"))
										{
											echo "<a href=\"../uploaded_images/".$image_id.".jpg\" class=\"hover\"><img src=\"../thumbnails/".$image_id.".jpg\" class=\"admin-preview-thumbnail\"/></a>";
										}
										
									}
									?>
									
									
									<?php
								}
								else
								{
									?>
									<img src="../images/no_pic.gif" width="50" class="admin-preview-thumbnail"/>
									<?php
								}
																	
								?>	
								<div class="clearfix"></div>
								
								<a class="underline-link" href="index.php?page=images&id=<?php echo $id;?>"><?php echo $this->texts["modify"];?></a>
									
						</fieldset>
						
						
						<div class="clearfix"></div>
						<br/>
						<button type="submit" class="btn btn-primary pull-right"> <?php echo $this->texts["submit"];?> </button>
						<div class="clearfix"></div>
					</form>
				
				</div>
				
			</div>

	</div>
