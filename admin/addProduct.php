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
<small id="sku_error"></small>
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
<small id="domain_error"></small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">Language/Technology Support</label>
<input class="form-control" type="text" id="support" name="support">
<small>Separate by (,) Ex: PHP, MySQL, MongoDB</small>
</div>
<div class="form-group">
<label for="example-email-input" class="form-control-label">MailBox</label>
<input class="form-control" type="text" id="mailbox" name="mailbox">
<small id="mail_error"></small>
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
      var first=f.charCodeAt(0);
        var length=f.length;
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
     $("#sku").focusout(function(){
       
       var sku=$("#sku").val();
       //Will only take # and - as special characters
       for(var i=0;i<sku.length;i++)
       {
         var first=sku.charAt(0);
         
         var length=sku.length-1;
         var ch=sku.charCodeAt(i);
         var ch2=sku.charCodeAt(i+1);
         //To check for double spaces
         if(sku.startsWith("#") || sku.startsWith("-"))
         {
            sku.trim();
            var second=sku.charAt(1);
            var char2=sku.charCodeAt(1);
           //if string starts with # or - and has other alphabets followed
            if(((char2>47 && char2<58)||(char2>64 && char2<91)||(char2>96 && char2<123)))
            {
              $("#sku_error").text("Valid input");
              return true;
            }
            if(char2==45 || char2==35)
            {
              // $("#sku_error").text("Single special character not allowed");
              // $("#sku").val("");\
              $("#sku_error").text("Invalid input");
              $("#sku").val("");
            }
          
         }
         if(!((ch>47 && ch<58)||(ch>64 && ch<91)||(ch>96 && ch<123)||(ch==45)||(ch==35)))
         {
          $("#sku_error").text("invalid input");
          $("#sku").val("");

         }
         
         if(ch==32 && ch2==32)
         {
          //$("#sku_error").text("");
           //Double spaces not allowed.
           //alert("double space");
           $("#sku_error").text("Extra white space not allowed");
           $("#sku").val("");
         }
         if(sku.charCodeAt(length-1)==32)
         {
          console.log("last character cant be a zero");
          $("#sku_error").text("Cannot end a string with a whitespace");
          $("#sku").val("");
         }
       }
     });
    //SKU Validation complete
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
      
      //DOMAIN
     $("#freedomain").focusout(function(){
        var f=$("#freedomain").val();
        var first=f.charCodeAt(0);
        var length=f.length;
        // console.log(length);
        if( !((first>47&&first<58) || (first>64&&first<91) || (first>96 && first<123)) && (length==1))
        {
          $("#domain_error").text("Invalid input");
            $("#freedomain").val("");
            // return false;
        }
        if( ((first>47&&first<58) || (first>64&&first<91) || (first>96 && first<123)) && (length==1))
        {
          $("#domain_error").text("Valid input");
            // $("#mailbox").val("");
            return true;
        }

       for(var i=0;i<f.length-1;i++)
       {
         var length=f.length-1;
         var c=f.charAt(i);
         var c2=f.charAt(i+1);
         var ch=f.charCodeAt(i);
         var ch2=f.charCodeAt(i+1);
       
          if((c==" ") || (c=="."))
          {
            $("#domain_error").text("Whitespace or . is not allowed");
            $("#freedomain").val("");
          }
          if((ch>47 && ch<58))
          {
            //first character is numeric
            if(!(ch2>47 && ch2<58))
            {
              //if second character is not numeric then invalid input.
              $("#domain_error").text("Either numeric or alphabetic.But can't be both.Also you can't use . or whitespace");
              $("#freedomain").val("");
              return false;

            }
            else{
              $("#domain_error").text("Valid Input");
            }
          }
          if((ch>64 && ch<91) || (ch>96 && ch<123))
          {
            if((ch2>47 && ch2<58))
            {
              //if second character is not numeric then invalid input.
              $("#domain_error").text("Either numeric or alphabetic.But can't be both.Also you can't use . or whitespace");
              $("#freedomain").val("");
              return false;

            }
            $("#domain_error").text("valid");
          }
          
         }
     });


     //MAILBOX
     $("#mailbox").focusout(function(){
        var f=$("#mailbox").val();
        var first=f.charCodeAt(0);
        var second=f.charCodeAt(1);
        var length=f.length;
        // console.log(f.length);
        if( !((first>47&&first<58) || (first>64&&first<91) || (first>96 && first<123)) && (length==1))
        {
          $("#mail_error").text("Invalid input");
            $("#mailbox").val("");
            return false;
        }
        if( ((first>47&&first<58) || (first>64&&first<91) || (first>96 && first<123)) && (length==1))
        {
          $("#mail_error").text("Valid input");
            // $("#mailbox").val("");
            return true;
        }

       for(var i=0;i<f.length-1;i++)
       {
         var length=f.length-1;
         var c=f.charAt(i);
         var c2=f.charAt(i+1);
         var ch=f.charCodeAt(i);
         var ch2=f.charCodeAt(i+1);
         //console.log(first);
          if((c==" ") || (c=="."))
          {
            $("#mail_error").text("Whitespace or . is not allowed");
            $("#mailbox").val("");
          }
          if((ch>47 && ch<58))
          {
            //first character is numeric
            if(!(ch2>47 && ch2<58))
            {
              //if second character is not numeric then invalid input.
              $("#mail_error").text("Either numeric or alphabetic.But can't be both.Also you can't use . or whitespace");
              $("#mailbox").val("");
              return false;

            }
            else{
              $("#mail_error").text("Valid Input");
            }
          }
          if((ch>64 && ch<91) || (ch>96 && ch<123))
          {
            if((ch2>47 && ch2<58))
            {
              //if second character is not numeric then invalid input.
              $("#mail_error").text("Either numeric or alphabetic.But can't be both.Also you can't use . or whitespace");
              $("#mailbox").val("");
              return false;

            }
            $("#mail_error").text("valid");
          }
          // else{
          //    $("#mail_error").text("Either numeric or alphabetic.But can't be both.Also you can't use . or whitespace");
          //     $("#mailbox").val("");
          //     return false;
          // }
         }
     });
    
    

  });
</script>