<?php include("header.php"); ?>
	<!---header--->

	<!---header--->
		<!---singleblog--->

        <?php
        if(isset($_GET['ID']))
        {
            $ID=$_GET['ID'];
            $arr=$obj->showHeaderinHosting($ID,$db->conn);
            foreach($arr as $key=>$value)
            {
                echo $value['html'];

            }
        }
       ?>
		<div class="tab-prices">
						<div class="container">
							<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs left-tab" role="tablist">
									<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">IN Hosting</a></li>
									<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">US Hosting</a></li>
									</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
										<div class="linux-prices">
											<!-- <div class="col-md-3 linux-price">
												<div class="linux-top">
												<h4>Standard</h4>
												</div>
												<div class="linux-bottom">
													<h5>$279 <span class="month">per month</span></h5>
													<h6>Single Domain</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/india.png"></li>
													</ul>
												</div>
												<a href="#">buy now</a>
											</div>
											<div class="col-md-3 linux-price">
												<div class="linux-top">
												<h4>Advanced</h4>
												</div>
												<div class="linux-bottom">
													<h5>$279 <span class="month">per month</span></h5>
													<h6>2 Domain</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/india.png"></li>
													</ul>
												</div>
												<a href="#">buy now</a>
											</div>
											<div class="col-md-3 linux-price">
												<div class="linux-top">
												<h4>Business</h4>
												</div>
												<div class="linux-bottom">
													<h5>$279 <span class="month">per month</span></h5>
													<h6>3 Domain</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/india.png"></li>
													</ul>
												</div>
												<a href="#">buy now</a>
											 </div> -->
											 <?php
												$arr=$obj->showProductsBelowHosting($db->conn,$_GET['ID']);
												print_r($arr);
											if(isset($arr))
											{
												foreach($arr as $key=>$value)
												{
													if($value['prod_parent_id']==$_GET['ID'])
													{
													$details=json_decode($value['description'],true);

													//print_r($value);
												?>
											<div class="col-md-3 linux-price">
												<div class="linux-top">
												<h4>Pro</h4>
												</div>
												<div class="linux-bottom">
													<h5> ₹ <?php echo $value['mon_price'];?>/-<span class="month"> per month</span></h5>
													<h5> ₹ <?php echo $value['annual_price'];?>/- <span class="month"> per year</span></h5>
													<h6><?php echo$value['prod_name'];?></h6>
													<ul>
													<li><strong>Webspace:- </strong><?php echo $details['webspace'];?></li>
													<li><strong>Bandwidth:- </strong><?php echo $details['bandwidth'];?></li>
													<li><strong>Free Domain:- </strong><?php echo $details['freedomain'];?></li>
													<li><strong>Support:- </strong><?php echo $details['support'];?></li>
													<li><strong>Mailbox:- </strong><?php echo $details['mailbox'];?></li>
													<li><strong>Stock Keeping Unit:- </strong><?php echo $value['sku'];?></li>
													<li><strong>Product Status:- </strong><?php
																							   if($value['prod_available']==1)
																							   {
																								   echo "Available";
																							   }
																							   if($value['prod_available']==0){
																								   echo "Unavailable";
																							   }?></li>
													<li><strong>location</strong> : <img src="images/india.png"></li>
													</ul>
												</div>
												<a href="#">buy now</a>
											</div>
											<?php
													}
											}
										}
											?>
											<div class="clearfix"></div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
									<div class="linux-prices">
											<div class="col-md-3 linux-price">
												<div class="linux-top us-top">
												<h4>Standard</h4>
												</div>
												<div class="linux-bottom us-bottom">
													<h5>$259 <span class="month">per month</span></h5>
													<h6>Single Domain</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/us.png"></li>
													</ul>
												</div>
												<a href="#" class="us-button">buy now</a>
											</div>
											
											<div class="col-md-3 linux-price">
												<div class="linux-top us-top">
												<h4>Business</h4>
												</div>
												<div class="linux-bottom us-bottom">
													<h5>$539 <span class="month">per month</span></h5>
													<h6>3 Domains</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/us.png"></li>
													</ul>
												</div>
												<a href="#" class="us-button">buy now</a>
											</div>
											<div class="col-md-3 linux-price">
												<div class="linux-top us-top">
												<h4>Pro</h4>
												</div>
												<div class="linux-bottom us-bottom">
													<h5>$639 <span class="month">per month</span></h5>
													<h6>Unlimited Domains</h6>
													<ul>
													<li><strong>Unlimited</strong> Disk Space</li>
													<li><strong>Unlimited</strong> Data Transfer</li>
													<li><strong>Unlimited</strong> Email Accounts</li>
													<li><strong>Includes </strong>  Global CDN</li>
													<li><strong>High Performance</strong>  Servers</li>
													<li><strong>location</strong> : <img src="images/us.png"></li>
													</ul>
												</div>
												<a href="#" class="us-button">buy now</a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- clients -->
				<div class="clients">
					<div class="container">
						<h3>Some of our satisfied clients include...</h3>
						<ul>
							<li><a href="#"><img src="images/c1.png" title="disney" /></a></li>
							<li><a href="#"><img src="images/c2.png" title="apple" /></a></li>
							<li><a href="#"><img src="images/c3.png" title="microsoft" /></a></li>
							<li><a href="#"><img src="images/c4.png" title="timewarener" /></a></li>
							<li><a href="#"><img src="images/c5.png" title="disney" /></a></li>
							<li><a href="#"><img src="images/c6.png" title="sony" /></a></li>
						</ul>
					</div>
				</div>
       <!-- clients -->
					<!-- Wordpress Features -->
					<div class="features">
						<div class="container">
							<h3>Wordpress Features</h3>
							<div class="features-grids">
								<div class="col-md-4 features-grid">
									<img src="images/f1.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f2.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f3.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
								<div class="clearfix"></div>
							</div>
							<div class="features-grids">
								<div class="col-md-4 features-grid">
									<img src="images/f4.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f5.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
									<div class="col-md-4 features-grid">
										<img src="images/f6.png">
										<h4>Expert Web Design</h4>
										<p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore </p>
									</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<!-- Wordpress Features -->
				</div>
			<!---footer--->
				<?php include("footer.php"); ?>
			<!---footer--->
			
			
</body>
</html>