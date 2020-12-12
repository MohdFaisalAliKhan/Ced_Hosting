<?php
include("header.php");
$db=new db();
$obj=new backbone();

if(isset($_GET['ID']))
    {
    	$ID=$_GET['ID'];
        $arr=$obj->editCategory($ID,$db->conn);
        //This array is here to show the values in field that were submitted before edit button is clicked
        
    }
if(isset($_POST['submitCategory']))
    {
    
    //$prod_parent_id=$_POST['selectProductName'];
    //echo ($prod_parent_id);
    $name=$_POST['Product_name'];
    //echo ($name);
    $link=$_POST['Product_link'];
    //echo ($link);
    $avail=$_POST['selectAvail'];
    //echo ($avail);
    $ID=$_GET['ID'];
    $obj->updateTbl_product($name,$link,$avail,$db->conn,$ID);

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
                        <div class="input-group mb-3">
                          <input value="<?php $id=1; 
                                               if($id==1)
                                              {
                                                echo 'Hosting';
                                               }
                                        ?>" class="form-control" placeholder="Service Name" type="text" name="Product_name" disabled>
                        </div>
                     </div>
                          <?php
                        //   TO SHOW HOSTING INSTEAD OF THE ID 
                            // $i=$value['prod_parent_id'];
                            // $sql="SELECT * FROM `tbl_product`";
                            // $res=mysqli_query($db->conn,$sql);
                            // if(mysqli_num_rows($res)>0){
                            //   while($row=$res->fetch_assoc())
                            //   {
                            //     $HostingName=$row['prod_name'];
                            //     if($row['id']==$_GET['ID'])
                            //     {
                            //       echo "<option value=".$row['id']." selected>".$HostingName."</option>";
                            //     }
                            //     else{
                            //       echo "<option value=".$row['id'].">".$HostingName."</option>";
                            //     }
                            //   }
                            // echo $HostingName;
                            // }
                          ?>
<!--                      
                  </select>
                </div> -->
                <!-- PRODUCT NAME -->
                <div class="form-group">
                  <div class="input-group mb-3">
                    <input value="<?php echo $value['prod_name']; ?>" class="form-control" placeholder="Product Name" type="text" name="Product_name">
                  </div>
                </div>
                <!-- LINK -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <input value="<?php echo $value['link']; ?>" class="form-control" placeholder="Link" type="text" name="Product_link">
                  </div>
                </div>
                <!-- PRODUCT AVAILABILITY -->
                <div class="form-group">
                  <select name="selectAvail" id="selectAvail" style="width:418px;padding:7px;">
                     <option value=1>
                          Available
                     </option>
                     <option value=0>
                          Not Available
                     </option>
                  </select>
                </div>
                <!-- BUTTON -->
                 <div class="text-center">
                  <button type="submit" name="submitCategory" class="btn btn-primary mt-4">Update Category</button>
                </div>

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