<?php
include "layouts/header.php";
$sqlCourses = "SELECT * FROM course";
$courses = mysqli_query($conn, $sqlCourses);

$errors = [];

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $course_id = $_POST['course_id'];

  if (empty($name)) {
    $errors['name_r'] = "Name is Required";
  }
  if (empty($address)) {
    $errors['address_r'] = "Address is Required";
  }
  if (empty($email)) {
    $errors['email_r'] = "Email is Required";
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email_i'] = "Invalid Email Address";
    }
  }

  $phoneRgx = "/(84|0[3|5|7|8|9])+([0-9]{8})\b/";
  if (empty($phone)) {
    $errors['phone_r'] = "Phone Number is Required";
  } else {
    if (!preg_match($phoneRgx, $phone)) {
      $errors['phone_i'] = "Invalid Phone Number Format";
    }
  }

  if (!$errors) {
    $sql = "INSERT INTO account (full_name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
    $query = mysqli_query($conn, $sql);
    $user_id = mysqli_insert_id($conn);
    if ($query) {
      $sql = "INSERT INTO courseregister(user_id, course_id) VALUES ('$user_id', '$course_id')";
      $query2 = mysqli_query($conn, $sql);

      if ($query2) {
        $sqlCourse = "SELECT * FROM course WHERE id = $course_id";
        $course = mysqli_query($conn, $sqlCourse);
        $course = mysqli_fetch_assoc($course);
        header('location: index.php');
        exit;
      }
    }
  }
}

?>

<div class="container p-5">
  <form action="" method="post">

    <?php if ($errors) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <?php foreach ($errors as $key => $value) { ?>

          <strong>
            <?= $value . "<br>" ?>
          </strong>
        <?php } ?>
      </div>
    <?php } ?>


    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Full Name">
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" class="form-control" placeholder="Email Address">
    </div>

    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="text" name="phone" id="phone" class="form-control" placeholder="Phome Number">
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label for="course_id">Course</label>
      <select class="form-control" name="course_id" id="course_id">
        <?php foreach ($courses as $key => $value) { ?>
          <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
        <?php } ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
</div>


<?php
include "layouts/footer.php"
?>