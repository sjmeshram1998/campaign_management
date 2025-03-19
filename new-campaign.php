     <!-- UPLOAD NEW CAMPAIGN THROUGH EXCEL STARTS -->
     <div class="modal fade" id="addCampExcelModal" tabindex="-1" role="dialog" aria-labelledby="addCampExcelLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="addCampExcelLabel">Add Campaign Through Excel</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                  
                     <div class="container">
                        <div class="card p-3">
                        <h1 class=text-center>Upload Excel File</h1><br>
                        <form action="http://localhost/crm1/insert-new-camp.php" method="POST" enctype="multipart/form-data">
                              <input type="file" name="import-file" required class="form-control" style="line-height: 1.1;"><br>
                              <button type="submit" class="btn" style="background-color: #0F8EB6 !important; color: white !important;" name="insert-new-camp">Upload</button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<!-- UPLOAD NEW CAMPAIGN THROUGH EXCEL ENDS -->