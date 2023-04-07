<?php include 'inc/header.php'; ?>

<?php
// Set vars to empty values
$name = $email = $feedback = '';
$nameErr = $emailErr = $Errfeedback = '';

// Form submit
if (isset($_POST['submit'])) {
  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(
      INPUT_POST,
      'name',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // Validate body
  if (empty($_POST['feedback'])) {
    $bodyfeedback = 'Body is required';
  } else {
    // $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $feedback = filter_input(
      INPUT_POST,
      'feedback',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if (empty($nameErr) && empty($emailErr) && empty($feedbackErr)) {
    // add to database
    $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: feedback.php');
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>

    <img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Feedback</h2>
    <?php echo isset($name) ? $name : ''; ?>
    <p class="lead text-center">Leave feedback for Traversy Media</p>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !$emailErr ?:
          'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
      </div>
      <div class="mb-3">
        <label for="feedback" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo !$Errfeedback ?:
          'is-invalid'; ?>" id="feedback" name="feedback" placeholder="Enter your feedback"><?php echo $feedback; ?></textarea>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include 'inc/footer.php'; ?>