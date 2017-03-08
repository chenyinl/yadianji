<?php
// ATN Product Lister, http://www.atnsolutions.com/product-lister
// A software product of ATN Solutions, All Rights Reserved
// Find out more about our products and services on:
// http://www.atnsolutions.com
// Released under the MIT license
?><?php
if(!defined('IN_SCRIPT')) die("");
?>
	<div class="header-line">
		  <div class="container">
		  
			<a href="index.php" style="margin-top:17px" class="btn btn-default pull-right"><?php echo $this->texts["go_back"];?></a>
			
			<h3><?php echo $this->texts["add_new_listing"];?></h3>
		  </div>
	</div>
	
	

	<div class="container">

			<br/>
			<?php
			$show_add_form=true;
			if(isset($_REQUEST["proceed_save"]))
			{
				///images processing
				$str_images_list = "";
				$limit_pictures=25;	
				$path="../";	
				include("include/images_processing.php");
				///end images processing
			
			
				$listings = simplexml_load_file($this->data_file);
		
			
				$listing = $listings->addChild('listing');
				$listing->addChild('title', stripslashes($_POST["title"]));
				$listing->addChild('description', stripslashes($_POST["description"]));
				$listing->addChild('price', stripslashes($_POST["price"]));
                $listing->addChild('cost', stripslashes($_POST["cost"]));
                $listing->addChild('brand', stripslashes($_POST["brand"]));
				$listing->addChild('images', $str_images_list);
				
				$listings->asXML($this->data_file); 
				?>
				<h3><?php echo $this->texts["new_added_success"];?></h3>
				<br/>
				<a href="index.php?page=add" class="underline-link"><?php echo $this->texts["add_another"];?></a>
				<?php echo $this->texts["or_message"];?>
				<a href="index.php?page=home" class="underline-link"><?php echo $this->texts["manage_listings"];?></a>
				<br/>
				<br/>
				<br/>
				<?php
				$show_add_form=false;
			}	
			
			

			if($show_add_form)
			{
			?>
			
			<div class="row">
				<div class="col-md-8">
				
					<br/>
				
				
					<form id="main" action="index.php" method="post"   enctype="multipart/form-data">
					<input type="hidden" name="page" value="add"/>
					<input type="hidden" name="proceed_save" value="1"/>
						<fieldset>
							<legend><?php echo $this->texts["listing_details"];?></legend>
							<ol>
								<li>
									<label><?php echo $this->texts["title"];?>:</label>
									
									<input type="text" name="title" required value=""/>
								</li>
								<li>
									<label><?php echo $this->texts["description"];?>:</label>
									
									<textarea name="description" cols="40" rows="10"></textarea>
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
									
									<input type="text" name="price" value=""/>
								</li>
							<ol>
						</fieldset>
						
						<fieldset id="images_fieldset">
							<legend><?php echo $this->texts["images"];?></legend>
							<ol>
								<li>
									
									
										<script src="../js/jquery.uploadfile.js"></script>

							
										<div id="mulitplefileuploader"><?php echo $this->texts["please_select"];?></div>
										
										
										<div id="status"><i>
											
										</i>
										
										</div>
										<script>
										var uploaded_files="";
										$(document).ready(function()
										{
										var settings = {
											url: "upload.php",
											dragDrop:true,
											fileName: "myfile",
											maxFileCount:25,
											allowedTypes:"jpg,png,gif",	
											returnType:"json",
											 onSuccess:function(files,data,xhr)
											{
												if(uploaded_files!="") uploaded_files+=",";
												uploaded_files+=data;
												
											},
											afterUploadAll:function()
											{
												var preview_code="";
												var imgs = uploaded_files.split(",")
												for (var i = 0; i < imgs.length; i++)
												{
													preview_code+='<div class="img-wrap"><img width="120" src="uploads/'+imgs[i]+'"/></div>';
												}
												
												document.getElementById("status").innerHTML=preview_code;
												document.getElementById("list_images").value=uploaded_files;
											},
											showDelete:false,
											
											showProgress:true,
											showFileCounter:false,
											showDone:false
										}
										
										

										var uploadObj = $("#mulitplefileuploader").uploadFile(settings);


										});
										</script>
										
										<input type="hidden" name="list_images" value="<?php if(isset($_POST["list_images"])) echo $_POST["list_images"];?>" id="list_images"/>
									
										<div class="clearfix"></div>
								</li>
								
								
							</ol>
						</fieldset>
						
						
						<div class="clearfix"></div>
						<br/>
						<button type="submit" class="btn btn-primary pull-right"> <?php echo $this->texts["submit"];?> </button>
						<div class="clearfix"></div>
					</form>
				
				</div>
				
			</div>
			<?php
			}
			?>
	</div>
