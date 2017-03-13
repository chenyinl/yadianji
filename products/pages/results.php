<?php
// ATN Product Lister
// http://www.atnsolutions.com/product-lister
// Copyright (c) All Rights Reserved ATN Solutions
// Find out more about our products and services on:
// http://www.atnsolutions.com
// Released under the MIT license
?><?php
if(!defined('IN_SCRIPT')) die("");
?>
<br/>
<br/>

<h2 class="pull-left no-margin">
	<?php
	if(isset($_REQUEST["keyword_search"]))
	{
		echo $this->texts["search_results"];
	}
	else
	{
		echo $this->texts["our_ads"];
	}
	?>
</h2>
<div class="pull-right">
	<div class="view-select-tabs">
			<a href="#" id="list-view" class="current"><span>List View</span></a>
			<a href="#" id="grid-view"><span>Grid View</span></a>
		</div>
		<div class="pull-right r-format"><?php echo $this->texts["results_format"];?>: </div>
</div>		
<div class="clearfix"></div>		
		

<hr class="no-margin"/>
<br/>
<script src="js/results.js"></script>

	<div class="clearfix"></div>
	<div class="results-container">		
	
	<?php	
	$PageSize = intval($this->settings["website"]["results_per_page"]);
	
	if(!isset($_REQUEST["num"]))
	{
		$num=1;
	}
	else
	{
		$num=$_REQUEST["num"];
		$this->ms_i($num);
	}
	

	$listing_counter = -1;
	
	$listings = simplexml_load_file($this->data_file);
	
	$price_from = 0;
	$price_to = 0;
	$min_price = 0;
	$max_price = 0;
	$iTotResults = 0;
	
	
	if(isset($_REQUEST["amount"])&&trim($_REQUEST["amount"])!="")
	{
		$_REQUEST["amount"]=preg_replace("/[^\-0-9]/","",$_REQUEST["amount"]);
		

		$amount_items=explode("-",$_REQUEST["amount"]);
		
		if(sizeof($amount_items)==2)
		{
			$price_from=$amount_items[0];
			$price_to=$amount_items[1];
		}
		
	}
	
	foreach ($listings->listing as $listing)
	{
		$listing_counter++;
		$current_price = floatval($listing->price);
		
		
		//refine search
		if(isset($_REQUEST["only_picture"])&&$_REQUEST["only_picture"]==1)
		{
			if(trim($listing->images)=="") continue;
		}	

		if(isset($_REQUEST["keyword_search"])&&trim($_REQUEST["keyword_search"])!="")
		{
			if
			(
				stripos($listing->title, $_REQUEST["keyword_search"])===false
				&&
				stripos($listing->description, $_REQUEST["keyword_search"])===false
			)
			{
				continue;
			}
		}
		
		if($price_from!=0&&$price_to!=0)
		{
			if($current_price<$price_from) continue;
			if($current_price>$price_to) continue;
		}
		//end refine search
		
		
		
		
		
		if($current_price>$max_price) $max_price=$current_price;
		
		if($min_price==0)
		{
			$min_price=$current_price;
		}
		else
		if($min_price>$current_price)
		{
			$min_price=$current_price;
		}
			
		
		if($iTotResults>=($num-1)*$PageSize&&$iTotResults<$num*$PageSize)
		{
		
			$images=explode(",",$listing->images);
			
			if($this->settings["website"]["seo_urls"]==1)
			{
				$strLink = "listing-".$this->format_str(strip_tags(stripslashes($listing->title)))."-".$listing_counter.".html";
			}
			else
			{
				$strLink = "index.php?page=details&id=".$listing_counter;
			}
			?>
			
		<div class="panel panel-default search-result">
				<div class="panel-heading">
					<h3 class="panel-title">
						
						<a href="<?php echo $strLink;?>" class="search-result-title"><?php echo $listing->title;?></a>
						
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<a href="<?php echo $strLink;?>" class="btn-block result-details-link"><img alt="<?php echo $listing->title;?>" class="img-responsive img-res" src="<?php if($images[0]==""||!file_exists("thumbnails/".$images[0].".jpg")) echo "images/no_pic.gif";else echo "thumbnails/".$images[0].".jpg";?>"/></a>
						</div>
						<div class="col-sm-8 col-xs-12">
							<div class="details">
								
								<p class="description">
									<?php echo $this->text_words(strip_tags($listing->description),80);?>
								</p>
								
								<?php
								if(trim($listing->price)!="")
								{
								?>
							
									<span class="listing-price"><?php echo $this->texts["price"];?>: <strong><?php echo $this->settings["website"]["currency"].$listing->price;?></strong></span>
								<?php
								}
								?>
                                <br/>
								<span class="listing-price"><?php echo $this->texts["sku"];?>: <strong><?php echo $listing->sku;?></strong></span>
                                <span class="is_r_featured"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
						
						</div>
						<div class="col-xs-6">
							<div class="text-right">
								<a href="<?php echo $strLink;?>" class="btn btn-primary"><?php echo $this->texts["details"];?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				
			
		}
			
		$iTotResults++;
	}
	?>
	</div>
	<div class="clearfix"></div>	
	<?php
	$strSearchString = "";
			
	foreach ($_POST as $key=>$value) 
	{ 
		if($key != "num"&&$value!="")
		{
			$strSearchString .= $key."=".$value."&";
		}
	}
	
	foreach ($_GET as $key=>$value) 
	{ 
		if($key != "num"&&$value!="")
		{
			$strSearchString .= $key."=".$value."&";
		}
	}
		
		
	if(ceil($iTotResults/$PageSize) > 1)
	{
		echo '<ul class="pagination">';
		
	
		
		$inCounter = 0;
		
		if($num > 2)
		{
			echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=1\"> << </a></li>";
			
			echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=".($num-1)."\"> < </a></li>";
		}
		
		$iStartNumber = $num-2;
		
	
		if($iStartNumber < 1)
		{
			$iStartNumber = 1;
		}
		
		for($i= $iStartNumber ;$i<=ceil($iTotResults/$PageSize);$i++)
		{
			if($inCounter>=5)
			{
				break;
			}
			
			if($i == $num)
			{
				echo "<li><a><b>".$i."</b></a></li>";
			}
			else
			{
				echo "<li><a class=\"pagination-link\" href=\"index.php?".$strSearchString."num=".$i."\">".$i."</a></li>";
			}
							
			
			$inCounter++;
		}
		
		if(($num+1)<ceil($iTotResults/$PageSize))
		{
			echo "<li><a href=\"index.php?".$strSearchString."num=".($num+1)."\"> ></b></a></li>";
			
			echo "<li><a href=\"index.php?".$strSearchString."num=".(ceil($iTotResults/$PageSize))."\"> >> </a></li>";
		}
		
		echo '</ul>';
	}
	
	
	
	
	if($iTotResults==0)
	{
		?>
		<i><?php echo $this->texts["no_results"];?></i>
		<?php
	}
	?>
	
<script>
var min_price=<?php echo $min_price;?>;
var max_price=<?php echo $max_price;?>;
</script>

<?php
$this->Title($this->texts["our_ads"]);
$this->MetaDescription("");
?>
