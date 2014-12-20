<?php

require_once 'views/header.php';
require_once 'views/nav.php';
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Data Update Request</h1>
           
          <div class="row">
              <div class="col-md-7">
                  <form class="form" method="POST" role="form" enctype="multipart/form-data">

                  
                  <div class="form-group">
                      <label >Request Details:</label>
                      <textarea class="form-control" name="request_details" rows="3"></textarea>
                    </div>
                    
                  <div class="form-group">
                      <label >Attach a file:</label>
                      <input type="file" class="form-control" name="request_attachment" id="" >
                    </div>
                  <br>
                  <button type="submit" class="btn btn-default">Submit</button>
                  <input type ="hidden" name="formHandler" value="create-request" />
                </form>
              </div>
              
              <div class="col-md-5">
                  <div class="panel panel-primary">
                            <div class="panel-heading">Update Request Instructions</div>
                            <div class="panel-body">
                                <ul>
                                    <li> Please enter detailed information about the data  you want updated in your record. you are required to add an attachment where necessary.</li>
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
          
          
        </div>
<?php  

require_once 'views/footer.php';



