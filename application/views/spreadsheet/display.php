
 <!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2>Import Data to Excel and CSV file using PhpSpreadsheet library in CodeIgniter and MySQL</h2>
      </div>
      <div class="row padall border-bottom">  
      <div class="col-lg-12">
      <div class="float-right">  
          <a href="<?php print site_url();?>" class="btn btn-info btn-sm"><i class="fa fa-file-upload"></i> Back to Upload</a>
        </div> 
      </div>
      </div>
      <div class="row padall">
        
        <table class="table table-striped">
          <thead>
            <tr class="table-primary">
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Email</th>
              <th scope="col">DOB</th>
              <th scope="col">Contact No</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($dataInfo as $key=>$element) { ?>
            <tr>
              <td><?php print $element['first_name'];?></td>
              <td><?php print $element['last_name'];?></td>
              <td><?php print $element['email'];?></td>
              <td><?php print $element['dob'];?></td>
              <td><?php print $element['contact_no'];?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
        
      </div>
    </div>
  </section>
 