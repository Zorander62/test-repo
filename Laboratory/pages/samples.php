<?php


//$samples = $db->getAllSamples(); // Assuming this function exists
?>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Manage Patients</p>
                <button class="btn btn-primary btn-sm ms-auto">New Patients</button>
              </div>
            </div>

            <div class="card-body p-4 ">
            <div class="table-responsive p-5">
              
            <table class="table">
            <thead>
            <tr>
                    <th>Sample ID</th>
                    <th>Patient Name</th>
                    <th>Test Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php //foreach ($samples as $sample): ?>
                    <tr>
                        <td><?php //echo $sample['sample_id']; ?></td>
                        <td><?php // $sample['patient_name']; ?></td>
                        <td><?php //echo $sample['test_type']; ?></td>
                        <td><?php //echo ucfirst($sample['status']); ?></td>
                        <td>
                            <a href="edit_test.php?id=<?php //echo $sample['sample_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_test.php?id=<?php //echo $sample['sample_id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php //endforeach; ?>
            </tbody>
        </table>
    </div>
            </div>

  </div>
  </div>
  </div>
  </div>


