<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$depts = new Departments();
if(isset($action) AND $action == 'edit'){
    $dept_form_status = 'edit-dept';
    $dep_data = $depts->getDept($data);
}else{
    $dept_form_status = 'add-dept';
}

if(isset($action) AND $action == 'delete'){
    if($depts->deleteDept($data) == false){
        $error = "Sorry, I couldnt delete the record";
    }else{
        $error = "Record has been deleted";
    }
}


?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Manage Departments</h1>
           
          <div class="row">
              <div class="col-md-7">
                <form class="form" role="form" method='POST'>

                  <div class="form-group">
                      <label >Department Name</label>
                      <input type="text" class="form-control" name="dept_name" id="" value="<?php echo $dep_data['dept_name']; ?>" >
                    </div>
                    
                  <div class="form-group">
                      <label >Location</label>
                      <input type="text" class="form-control" name="location" id="" value="<?php echo $dep_data['location']; ?>">
                    </div>
                  
                  <div class="form-group">
                      <label >Other Details</label>
                      <textarea class="form-control" name="other_details" rows="3"><?php echo $dep_data['other_details']; ?></textarea>
                    </div>
                  <br>
                  <button type="submit" class="btn btn-default">Submit</button>
                  <input type="hidden" name="formHandler" value="<?php echo $dept_form_status; ?>" />
                </form>
              </div>
              
              <div class="col-md-5">
                  <div class="panel panel-primary">
                            <div class="panel-heading">Instructions</div>
                            <div class="panel-body">
                                <ul>
                                    <li> </li>
                                </ul>
                            </div>
                            <div class="panel-footer"></div>
                          </div>
              </div>
              
          </div>
            
          
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
                        
                        <th>Department</th>
                        <th>Location</th>
                        <th>Other Details</th>
                        <th>Head of Department</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       <?php echo $depts->getDepts(); ?>
                    </tr>
                </tbody>
            </table>
          </div>
          
        </div>
<?php  

require_once 'views/footer.php';



