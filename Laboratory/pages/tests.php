<?php


//$tests = $db->getAllTests(); // Assuming this function exists
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
                    <th>Test Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php //foreach ($tests as $test): ?>
                    <tr>
                        <td><?php //echo $test['test_name']; ?></td>
                        <td><?php //echo $test['description']; ?></td>
                        <td>
                            <a href="edit_test.php?id=<?php //echo $test['test_id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_test.php?id=<?php //echo $test['test_id']; ?>" class="btn btn-danger">Delete</a>
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



  <div class="modal fade" id="addTestModal" tabindex="-1" role="dialog" aria-labelledby="addTestModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="add_test.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTestModalLabel">Add New Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="test_name">Test Name:</label>
                            <input type="text" class="form-control" name="test_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Test</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>