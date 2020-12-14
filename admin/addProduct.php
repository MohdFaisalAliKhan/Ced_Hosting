<?php include("header.php"); ?>

<?php 

if(isset($_POST['add_prod']))
{
  $obj=new backbone();

  $product_category=$_POST['parentid']; //Prod parent id
  $product_name=$_POST['product_name']; //prod name
  $product_html=$_POST['html'];         //prod html
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
    
    $obj->addProduct($product_category,$product_name,$product_html,$product_available,$monthly,$yearly,$sku
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
<input class="form-control" type="text" id="product_name" name="product_name" required>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Product URL</label>
<input class="form-control" type="text" id="example-email-input" name="html">
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
<input class="form-control" type="text" id="monthly" name="monthly" id="monthly">
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Annual Price</label>
<input class="form-control" type="text" id="yearly" name="yearly">
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">SKU</label>
<input class="form-control" type="text" id="sku" name="sku">
</div>
<hr class="my-3">
<h2>Features</h2>
<hr class="my-3">

<div class="form-group">
<label for="example-email-input" class="form-control-label">Web Space(in GB)</label>
<input class="form-control" type="text" id="webspace" name="webspace">
<small>Enter 0.5 for 512 MB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Bandwidth (in GB)</label>
<input class="form-control" type="text" id="bandwidth" name="bandwidth">
<small>Enter 0.5 for 512 MB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Free Domain</label>
<input class="form-control" type="text" id="freedomain" name="freedomain">
<small>Enter 0 for no domain available in this service</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Language/Technology Support</label>
<input class="form-control" type="text" id="support" name="support">
<small>Separate by (,) Ex: PHP, MySQL, MongoDB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">MailBox</label>
<input class="form-control" type="text" id="mailbox" name="mailbox">
<small>Enter Number of mailbox will be provided, enter 0 if none</small>
</div>

<input type="submit" class="btn btn-primary btn-lg btn-block" name="add_prod" id="add_prod" value="CREATE">
</form>

<?php include("footer.php"); ?>

<script>
  $(document).ready(function(){
    $("#add_prod").prop('disabled',true);
    
    //Product Name Validation
    $("#product_name").on('blur',function(){
      var p=$("#product_name").val();
      // var product_name=p.trim();
      if(p.match(/^[a-zA-Z_]+( [a-zA-Z_]+)(-[0-9]+(?!\-)+)$/))
      {
        alert("match");
      }
      else{
        alert("No match");
      }
    });
    
    //Monthly Price Validation
     $("#monthly").on('blur',function(){
        var m=$("#monthly").val();
        if(m.match(/^[0-9_]+(.[0-9]+)$/))
        {
          if(m.length>15)
          {
            alert("Length exceeded");
            $("#monthly").val("");
          }
          else{
            alert("match");
          }
          
        }
        else{
          alert("Not Match");
          $("#monthly").val("");
        }
     });
    
    //Annual Price Validation
     $("#yearly").on('blur',function(){
        var y=$("#yearly").val();
        if(y.match(/^[0-9_]+(.[0-9]+)$/))
        {
          if(y.length>15)
          {
            alert("Length exceeded");
            $("#yearly").val("");
          }
          else{
            alert("match");
          }
        }
        else{
          alert("not match");
          $("#yearly").val("");
        }
     });
     
     //SKU
     $("#sku").on('blur',function(){
       var sku=$("#sku").val();
       //Will only take # and - as special characters
       if(sku.match(/^[a-zA-Z0-9_]+( [a-zA-Z0-9\#\- _]+)$/))
      
       {
         alert("match");
       }
       else{
         alert("not match");
       }
     });

     $("#webspace").on('blur',function(){
        var w=$("#webspace").val();
        if(w.match(/^[0-9_]+(.[0-9])*$/))
        {
          if(w.length>5)
          {
            alert("length exceedes 5");
            $("#webspace").val("");
          }
          else{
            alert("Match");
          }
        }
        else{
          alert("not match");
          $("#webspace").val("");
        }
     });

     $("#bandwidth").on('blur',function(){
        var b=$("#bandwidth").val();
        if(b.match(/^[0-9_]+(.[0-9])*$/))
        {
          if(b.length>5)
          {
            alert("length exceedes 5")
            $("#bandwidth").val("");
          }
          else{
            alert("Match");
          }
        }
        else{
          alert("not match");
          $("#bandwidth").val("");
        }
     });

//      Free Domain/ Mailbox:-
//     -Only numeric/ only alphabetic(i.e. no combinations)
//     -No white spaces
//     -No "." allowed

     $("#freedomain").on('blur',function(){
        var f=$("#freedomain").val();
        if(f.match(/^[0-9_])*$/))
        {
          alert("match");
        }
        else
        {
          alert("not match");
        }
     });
    

  });
</script>