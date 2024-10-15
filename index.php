<!DOCTYPE html>
<html lang="en">

<?php

include "db.php";

$sql = "SELECT * FROM task";
$result = mysqli_query($conn, $sql);


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Todo List</title>
</head>

<body>
  <h1 class="text-center mt-5">Todo List</h1>

  <div class="container">
    <div class="row ">
      <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add Task</button>
        <button class="btn btn-success float-end">Print Task</button>
      </div>

      <hr>
      <br>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Task Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <th scope="row"><?php echo $row['id']; ?></th>
              <td><?php echo $row['name']; ?></td>
              <td>
              <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" 
                    data-id="<?php echo $row['id']; ?>" 
                    data-name="<?php echo $row['name']; ?>">Update</button>

                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>




  <!-- Modal Create -->
  <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Create Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="add.php" method="POST">
          <div class="modal-body">
            <input type="text" class="form-control" name="task" placeholder="Task Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Add Task</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="update.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="task-id">
            <input type="text" class="form-control" name="task" id="task-name" placeholder="Task Name">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var id = button.getAttribute('data-id');
      var name = button.getAttribute('data-name');

      var modalIdInput = editModal.querySelector('#task-id');
      var modalNameInput = editModal.querySelector('#task-name');

      modalIdInput.value = id;
      modalNameInput.value = name;
    });
  </script>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>