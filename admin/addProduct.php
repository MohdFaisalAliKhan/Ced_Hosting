<?php include("header.php"); ?>

<?php 

if(isset($_POST['add_prod']))
{
  $obj=new backbone();

  $product_category=$_POST['parentid']; //Prod parent id
  $product_name=$_POST['product_name']; //prod name
  $product_link=$_POST['link'];         //prod link
  $product_available=$_POST['selectAvail']; //prod available

  $monthly=$_POST['monthly'];
  $yearly=$_POST['yearly'];
  $sku=$_POST['sku'];
  
  $webspace=$_POST['webspace'];
  $bandwidth=$_POST['bandwidth'];
  $freedomain=$_POST['freedomain'];
  $support=$_POST['support'];
  $mailbox=$_POST['mailbox'];
  
  //CREATE ARRAY NOW
  $description=array(
         "webspace"=>$webspace,
         "bandwidth"=>$bandwidth,
         "freedomain"=>$freedomain,
         "support"=>$support,
         "mailbox"=>$mailbox );
    $arrJson=json_encode($description);
    
    $obj->addProduct($product_category,$product_name,$product_link,$product_available,$monthly,$yearly,$sku
    ,$arrJson ,$db->conn);




  


}


?>


<form class="w-50 mx-auto py-5" action="" method="POST">

<div class="form-group">
<label for="example-search-input" class="form-control-label">Product Category</label>
<?php
 $obj=new backbone();
 $arr=$obj->categoryShow($db->conn);
?>
<select name="parentid" id="parentid" class="form-control">
  <option value="0" selected>Select product Category</option>
<?php
foreach($arr as $key=>$value){
    if($value['id']!=1)
    {
      if($value['prod_parent_id']==1)
      {
        echo "<option value='".$value['id']."'>".$value['prod_name']."</option>";
      }
        
    }
}

?>


</select>
</div>
<div class="form-group">
<label for="example-text-input" class="form-control-label">Product Name</label>
<input class="form-control" type="text" id="example-text-input" name="product_name" required>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Product URL</label>
<input class="form-control" type="text" id="example-email-input" name="link">
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Product Availability</label>
                  <select name="selectAvail" id="selectAvail" style="width:418px;padding:7px;">
                     <option value=1>
                          Available
                     </option>
                     <option value=0>
                          Not Available
                     </option>
                  </select>
                </div>
<hr class="my-3">
<h2>Product Description</h2>
<hr class="my-3">
<div class="form-group">
<label for="example-email-input" class="form-control-label">Monthly Price</label>
<input class="form-control" type="text" id="example-email-input" name="monthly">
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Annual Price</label>
<input class="form-control" type="text" id="example-email-input" name="yearly">
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">SKU</label>
<input class="form-control" type="text" id="example-email-input" name="sku">
</div>
<hr class="my-3">
<h2>Features</h2>
<hr class="my-3">

<div class="form-group">
<label for="example-email-input" class="form-control-label">Web Space(in GB)</label>
<input class="form-control" type="text" id="example-email-input" name="webspace">
<small>Enter 0.5 for 512 MB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Bandwidth (in GB)</label>
<input class="form-control" type="text" id="example-email-input" name="bandwidth">
<small>Enter 0.5 for 512 MB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Free Domain</label>
<input class="form-control" type="text" id="example-email-input" name="freedomain">
<small>Enter 0 for no domain available in this service</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Language/Technology Support</label>
<input class="form-control" type="text" id="example-email-input" name="support">
<small>Separate by (,) Ex: PHP, MySQL, MongoDB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">MailBox</label>
<input class="form-control" type="text" id="example-email-input" name="mailbox">
<small>Enter Number of mailbox will be provided, enter 0 if none</small>
</div>

<input type="submit" class="btn btn-primary btn-lg btn-block" name="add_prod" value="CREATE">
</form>
<?php include("footer.php"); ?>