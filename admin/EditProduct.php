<?php
include("header.php");
$db=new db();
$obj=new backbone();

if(isset($_GET['ID']))
    {
        $ID=$_GET['ID'];
        //this ID is of product to be edited.
        $arr=$obj->editCategory($ID,$db->conn);
        $arr2=$obj->editProduct($ID,$db->conn);
        $arr3=$obj->getParentNameEdit($ID,$db->conn);
        //echo($_SESSION['mailbox']);
        //This array is here to show the values in field that were submitted before edit button is clicked
       // print_r($arr2);
       
    }
if(isset($_POST['submitProduct']))
    {
    
    //$prod_parent_id=$_POST['selectProductName'];
    //echo ($prod_parent_id);
    $parent_id=$_POST['parentname'];
    $name=$_POST['Product_name'];
    //echo ($name);
    $html=$_POST['Product_html'];
    //echo ($html);
    $avail=$_POST['selectAvail'];
    $webspace=$_POST['webspace'];
    $bandwidth=$_POST['Bandwidth'];
    $freeDomain=$_POST['Free_Domain'];
    $support=$_POST['Support'];
    $mail=$_POST['Mailbox'];
    $month=$_POST['Monthly_Price'];
    $annual=$_POST['Annual_Price'];
    $SKU=$_POST['SKU'];

    $description=array(
      "webspace"=>$webspace,
      "bandwidth"=>$bandwidth,
      "freedomain"=>$freeDomain,
      "support"=>$support,
      "mailbox"=>$mail );
    $arrJson=json_encode($description);

    // $description=array(
    //       "webspace"=>$webspace;
    // )
    //echo ($avail);
    $ID=$_GET['ID'];
    $obj->updateTbl_productAndDescription($parent_id,$name,$html,$avail,$arrJson,$month,$annual,$SKU,$db->conn,$ID);

    }   

?>
<div class="container pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
          
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                Edit Category
              </div>
              <form method="POST">
              <?php 
                   foreach($arr as $key=>$value)
                    { 
                        ?>
              <!-- PARENT PRODUCT ID -->
                <!-- <div class="form-group">
                  <select name="selectProductName" id="selectProductName" style="width:418px;padding:7px;">
                     <option  vlaue="0">Select Product Parent ID</option> -->
                    <div class="form-group">
                    <span>Parent Name<span>
                        <select name="parentname" id="parentname" style="width:418px;padding:7px;">
                            <?php
                            foreach($arr3 as $key2=>$value2)
                            {
                            ?>
                            <option value= <?php echo($value2['id']); ?>>
                                <?php echo $value2['prod_name']; 
                                 $_SESSION['thisparent']=$value2['id'];
                                ?>
                            </option>
                             <?php 
                             } 
                             ?>
                        </select>
                    </div>
                    
                          <!-- ?> -->
<!--                      
                  </select>
                </div> -->
                <!-- PRODUCT NAME -->
                <div class="form-group">
                <span>Product Name<span>
                <div class="input-group mb-3">
                   <input value="<?php echo $value['prod_name']; ?>" class="form-control" placeholder="Product Name" type="text" name="Product_name">
                </div>
                </div>
                <!-- HTML -->
                <div class="form-group">
                <span>Html<span>
                  <div class="input-group input-group-merge input-group-alternative">
                    <input value="<?php echo $value['html']; ?>" class="form-control" placeholder="HTML" type="text" name="Product_html">
                  </div>
                </div>
                <!-- PRODUCT AVAILABILITY -->
                <div class="form-group">
                <span>Product Availability<span>
                <select name="selectAvail" id="selectAvail" style="width:418px;padding:7px;">
                     <option value=1>
                          Available
                     </option>
                     <option value=0>
                          Not Available
                     </option>
                  </select>
                </div>
                <!-- WEBSPACE -->

                <?php 
                    foreach($arr2 as $key2=>$value2)
                     { 
                         $description=json_decode($value2['description'],true);
                         //print_r($description);
                        ?>

                <div class="form-group">
                <span>Web Space<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $description['webspace']; ?>" class="form-control" placeholder="webspace" type="text" name="webspace">
                  </div>
                </div>
                <!-- BANDWIDTH -->
                <div class="form-group">
                <span>Bandwidth<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $description['bandwidth']; ?>" class="form-control" placeholder="Bandwidth" type="text" name="Bandwidth">
                  </div>
                </div>
                <!-- FREE DOMAIN -->
                <div class="form-group">
                <span>Free Domain<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $description['freedomain']; ?>" class="form-control" placeholder="Free Domain" type="text" name="Free_Domain">
                  </div>
                </div>
                <!-- Support -->
                <div class="form-group">
                <span>Support<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $description['support']; ?>" class="form-control" placeholder="Support" type="text" name="Support">
                  </div>
                </div>
                <!-- Mailbox -->
                <div class="form-group">
                <span>Mailbox<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $description['mailbox']; ?>" class="form-control" placeholder="Mailbox" type="text" name="Mailbox">
                  </div>
                </div>

                <!-- MONTHLY PRICE -->
                <div class="form-group">
                <span>Monthly Price<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $value2['mon_price']; ?>" class="form-control" placeholder="Monthly Price" type="text" name="Monthly_Price">
                  </div>
                </div>
                <!-- ANNUAL PRICE -->
                <div class="form-group">
                <span>Annual Price<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $value2['annual_price']; ?>" class="form-control" placeholder="Annual Price" type="text" name="Annual_Price">
                  </div>
                </div>
                <!-- SKU -->
                <div class="form-group">
                <span>SKU<span>
                  <div class="input-group mb-3">
                    <input value="<?php echo $value2['sku']; ?>" class="form-control" placeholder="SKU" type="text" name="SKU">
                  </div>
                </div>

                <!--  -->
                
                <!-- CLOSING OF ARRAY 2 -->
                <?php
                    }
                 ?>


                <!-- BUTTON -->
                 <div class="text-center">
                  <button type="submit" name="submitProduct" class="btn btn-primary mt-4">Update Product</button>
                </div>

                 <!-- CLOSING OF ARRAY 1 -->
                 <?php
                     }
                 ?>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include("footer.php"); ?>