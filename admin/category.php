<?php require_once("header.php");
      $db=new db();
      $obj=new backbone();
      if(isset($_POST['submitCategory']))
      {
        
        $prod_parent_id=$_POST['selectProductName'];
        //echo ($prod_parent_id);
        $name=$_POST['Product_name'];
        //echo ($name);
        $link=$_POST['Product_link'];
        //echo ($link);
        $avail=$_POST['selectAvail'];
        //echo ($avail);
        $obj->insertTbl_product($prod_parent_id,$name,$link,$avail,$db->conn);

      }   
?>
<div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tables</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Tables</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Light table</h3>
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush" id="myTable">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Product ID</th>
                    <th scope="col" class="sort" data-sort="budget">Parent Product Name</th>
                    <th scope="col" class="sort" data-sort="status">Product Name</th>
                    <th scope="col">Link</th>
                    <th scope="col" class="sort" data-sort="completion">Product Available</th>
                    <th scope="col">Product Launch Date</th>
                    <th scope="col">Action</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody class="list">

                <?php 
                    $obj=new backbone();
                    $Rows=$obj->categoryShow($db->conn);
                    foreach($Rows as $key=>$value)
                    { 
                    if($value['id']!=1)
                    {

                    ?>
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center text-center">
                        <!-- <a href="#" class="avatar rounded-circle mr-3">
                          <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                        </a> -->
                        <div class="media-body">
                          <span class="name mb-0 text-sm"><?php echo($value['id']); ?></span>
                        </div>
                      </div>
                    </th>
                    <td class="budget">
                         <?php 
                               $Name=$obj->parentProductName($value['prod_parent_id'],$db->conn);
                               echo $Name;
                                
                                ?>
                    </td>
                    <td>
                      <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        <span class="status">
                            <?php echo($value['prod_name']); ?>
                        </span>
                      </span>
                    </td>
                    <td>
                      <div class="avatar-group">
                        <a href="#" data-toggle="tooltip">
                        <?php echo($value['link']); 
                              if(!isset($value['link']))
                              {
                                echo "<a href='#'>NULL</a>";
                              }    
                                  ?>
                        </a>
                       
                      </div>
                    </td>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="completion mr-2"><?php 
                                    if($value['prod_available']==1)
                                    {
                                      echo "Available";
                                    }
                                    else{
                                      echo "Not Available";
                                    }
                        ?></span>
                        <!-- <div>
                          <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                          </div>
                        </div> -->
                      </div>
                    </td>
                    <td class="text-right">
                      <!-- <div class="dropdown"> -->

                        <span class="status">
                            <?php echo($value['prod_launch_date']); ?>
                        </span>
                        <!-- <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div> -->
                      <!-- </div> -->
                    </td>
                    <td>
                       <?php echo "<a href='EditCategory.php?ID=".$value['id']."  ' style='padding:7px;background:lightblue;color:black'>EDIT</a>";?>
                    </td>
                    <td>
                       <?php echo "<a href='../classes.php?Name=".$value['prod_name']." ' style='padding:7px;background:#FFCCCB;color:black'>DELETE</a>"; ?>
                    </td>
                  </tr>
                   
                   <?php
                    } 
                  }
                   ?>


                </tbody>
              </table>
            </div>
            <!-- Card footer -->
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- Dark table -->
     
    </div>

    <!-- FORM ////////////////////////////////////////////////////////////////////////// -->
    <div class="container pb-5">
      <!-- Table -->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
          
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <small>Create Category</small>
              </div>
              <form method="POST">
              <!-- PARENT PRODUCT ID -->
                <div class="form-group">
                  <select name="selectProductName" id="selectProductName" style="width:418px;padding:7px;">
                     <option selected vlaue="0">Select Product Parent ID</option>
                     <option value=1 >
                          <?php
                            $obj=new backbone();
                            $name=$obj->showParentCategory(1,$db->conn);
                            echo $name;
                          ?>
                     </option>
                  </select>
                </div>
                <!-- PRODUCT NAME -->
                <div class="form-group">
                  <div class="input-group mb-3">
                    <input class="form-control" placeholder="Product Name" type="text" name="Product_name">
                  </div>
                </div>
                <!-- LINK -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <input class="form-control" placeholder="Link" type="text" name="Product_link">
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
                  <button type="submit" name="submitCategory" class="btn btn-primary mt-4">Create Category</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


      <?php require_once("footer.php"); ?>
     


          
