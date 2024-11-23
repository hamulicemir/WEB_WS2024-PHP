<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing-Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link href="index.stylesheet.css" rel="stylesheet">
</head>
<body>
  <div class="header">
  </div>
    <?php include './inc/nav.php';?>

      <main>
        <div class="content">
          <h1>Welcome to the Adi & Emir Hotels</h1>
          <p>Your comfort is our priority.</p>
        </div>
          <h2>Newsfeed</h2>
      </main>

      <footer class="footer">
        <div class="container">
          <span class="text-muted">© 2024 Hotels by Adi & Emir</span>
        </div>
      </footer>

</body>
</html>