<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$depts = new Departments();
$acc = new StaffAccounts();
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Search Users</h1>
           
          <form class="form-inline" role="form" action="" method="POST">
                <div class="form-group col-md-4">
                  
                    <input type="text" class="form-control " style="width: 100%" id="" name="searchQ" value="<?php echo $_POST['searchQ']; ?>" placeholder="Enter Staff Number/Name">
                </div>
                <div class="form-group">
                  <div class="input-group">                   
                      <select name="dept" class="form-control">
                          <option value="All">All</option>
                          <?php 
                            $utils = new Utilities();
                          echo $utils->getDepts(); ?>
                      </select>
                  </div>
                </div>
                
                
               
                <button type="submit" class="btn btn-default">Search</button>
                <input type="hidden" name="formHandler" value="searchUsers" />
              </form>
          
          <br>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php echo $error; ?>
          </div>
          <hr/>
          
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photograph</th>
                        <th>Staff Number</th>
                        <th>Staff Name</th>
                        <th>Account Type</th>
                        <th>Department</th>                        
                        <th>Level</th>
                        <th>Step</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php echo $searchResult; ?>
                </tbody>
            </table>
          </div>
        </div>
<?php  

require_once 'views/footer.php';



