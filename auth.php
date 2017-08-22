<?php 
session_start();
?>
<html >
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link href="css/style.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div class="login">
	<h1>Simple-Solutions</h1>
    <form method="post" autocomplete="off" action="index.php">
        <input type="hidden" name="req_url" class="input" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<input type="text" name="login" placeholder="Логин" class="input" required="required" />
        <input type="password" class="input" name="password" placeholder="Пароль" required="required" />
		<div><input id="mc"   style=" margin-bottom:3%; " name="remember_me" value="1" type="checkbox">
		<label style="color:#c0c0c0;">Запомнить меня</label></div>
        <button type="submit" class="btn btn-primary btn-block btn-large">Войти</button>
    </form>
</div>
  


</body>
</html>