
<html>

<head>
  <title>TIH backend</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h2>CRUD Operation</h2>
    <div class="py-4">
      <button type="button" class="btn btn-info float-end" data-bs-toggle="modal" data-bs-target="#adduser">Add
        User</button>
    </div>
    <div class="py-4">
      <table class="table" id="user">
        <thead>
          <tr>
            <th class="text-center"scope="col">S.No</th>
            <th class="text-center" scope="col">Name</th>
            <th class="text-center" scope="col">Department</th>
            <!-- <th class="text-center" scope="col">Action</th> -->

          </tr>
        </thead>
        <tbody>
        @foreach($var as $obj)
        <tr>
            <td>{{$obj->id}}</td>
            <td>{{$obj->name}}</td>
            <td>{{$obj->dept}}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>

  </div>

  <!-- add user Modal -->
  <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addnewuser">
            <input type="text" name="name" placeholder="Enter Name" required>
            <input type="text" name="dept" placeholder="Enter dept" required>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit user Modal -->
  <div class="modal fade" id="Edituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="Editnewuser">
            <input type="hidden" name="id" id="id" required>
            <input type="text" name="name" id="name" placeholder="Enter Name" required>
            <input type="text" name="dept" id="dept" placeholder="Enter dept" required>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function () {
      $('#user').DataTable();
    });

    $(document).on('submit', '#addnewuser', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("save_newuser", true);
      $.ajax({
        type: "POST",
        url: "backend.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

          var res = jQuery.parseJSON(response);
          console.log(res)
          if (res.status == 200) {
            $('#adduser').modal('hide');
            $('#addnewuser')[0].reset();
            $('#user').load(location.href + " #user");
            alert("added successfully")

          }
          else if (res.status == 500) {
            $('#adduser').modal('hide');
            $('#addnewuser')[0].reset();
            console.error("Error:", res.message);
            alert("Something Went wrong.! try again")
          }
        }
      });

    });

    $(document).on('click', '.btnuserdelete', function (e) {
      e.preventDefault();

      if (confirm('Are you sure you want to delete this data?')) {
        var user_id = $(this).val();
        $.ajax({
          type: "POST",
          url: "backend.php",
          data: {
            'delete_user': true,
            'user_id': user_id
          },
          success: function (response) {

            var res = jQuery.parseJSON(response);
            if (res.status == 500) {
              alert(res.message);
            }
            else {
              $('#user').load(location.href + " #user");
            }
          }
        });
      }
    });

    $(document).on('click', '.btnuseredit', function (e) {
      e.preventDefault();
      var user_id = $(this).val();
      console.log(user_id)
      $.ajax({
        type: "POST",
        url: "backend.php",
        data: {
          'edit_user': true,
          'user_id': user_id
        },
        success: function (response) {

          var res = jQuery.parseJSON(response);
          console.log(res)
          if (res.status == 500) {
            alert(res.message);
          }
          else {
            //$('#student_id2').val(res.data.uid);

            $('#id').val(res.data.id);
            $('#name').val(res.data.name);
            $('#dept').val(res.data.dept);
            $('#Edituser').modal('show');
          }
        }
      });
    });

    $(document).on('submit', '#Editnewuser', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      console.log(formData)
      formData.append("save_edituser", true);
      $.ajax({
        type: "POST",
        url: "backend.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

          var res = jQuery.parseJSON(response);
          if (res.status == 200) {
            $('#Edituser').modal('hide');
            $('#Editnewuser')[0].reset();
            $('#user').load(location.href + " #user");
            alert(res.message)

          }
          else if (res.status == 500) {
            $('#Edituser').modal('hide');
            $('#Editnewuser')[0].reset();
            console.error("Error:", res.message);
            alert("Something Went wrong.! try again")
          }
        }
      });
    });

  </script>

</body>

</html>