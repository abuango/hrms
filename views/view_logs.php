<?php

require_once 'views/header.php';
require_once 'views/nav.php';
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Activity Logs </h1>
           
                    
          <h3>Logs for User: Maryam Muhammad Lawal</h3>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Error!</strong> No record found for selected options.
          </div>
          <hr/>
          
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date/Time</th>
                        <th>Activity Type</th>
                        <th>Details</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1/1/2001</td>
                        <td>CONTISS 14</td>
                        <td>Gombe</td>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
<?php  

require_once 'views/footer.php';



