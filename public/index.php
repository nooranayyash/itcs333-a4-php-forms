<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — contact form.
 */

require_once __DIR__ . '/../src/validate.php';

$name = '';
$email = '';
$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = (string) ($_POST['name'] ?? '');
    $email = (string) ($_POST['email'] ?? '');
    $message = (string) ($_POST['message'] ?? '');

    if (!validate_required($name)) {
        $errors['name'] = 'Name is required.';
    } elseif (!validate_length(trim($name), 2, 60)) {
        $errors['name'] = 'Name must be 2 to 60 characters.';
    }

    if (!validate_email($email)) {
        $errors['email'] = 'Please enter a valid email.';
    }

    if (!validate_required($message)) {
        $errors['message'] = 'Message is required.';
    } elseif (!validate_length(trim($message), 10, 1000)) {
        $errors['message'] = 'Message must be 10 to 1000 characters.';
    }

    if (empty($errors)) {
        header('Location: index.php?success=1', true, 303);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <?php if (isset($_GET['success'])): ?>
    <h1>Message sent successfully!</h1>
  <?php else: ?>
    <h1>Contact Us</h1>

    <form method="post" action="index.php">
      <label>Name
        <input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <?php if (isset($errors['name'])): ?>
        <p><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>
      <br>

      <label>Email
        <input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
      </label>
      <?php if (isset($errors['email'])): ?>
        <p><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>
      <br>

      <label>Message
        <textarea name="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>
      </label>
      <?php if (isset($errors['message'])): ?>
        <p><?= htmlspecialchars($errors['message'], ENT_QUOTES, 'UTF-8') ?></p>
      <?php endif; ?>
      <br>

      <button type="submit">Send</button>
    </form>
  <?php endif; ?>
</body>
</html>
