<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="wrapper">
<div class="form-container">
    <div class="content">
        <img src="assets/meatshop.png" alt="logo">
        <h2>The Butcher <span class="styled-word">Shop.</span> </h2>
      <form class="content__form" action="./process/login.php" method="POST">
        <div class="content__inputs">
          <label>
            <input required type="text" name="username" placeholder="Enter username">
          </label>
          <label>
            <input required type="password" name="password" placeholder="Enter password">
          </label>
        </div>
        <button>Log In</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>