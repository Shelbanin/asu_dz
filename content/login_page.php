<html>
	<head>
		<title>Авторизация</title>
		<link rel="stylesheet" href="static/style/login.css">
		<script src="static/js/login-script.js"></script>
		<meta charset="utf-8">
	</head>
	
	<body>
		<div id="wrapper">
			<div class="clear-block"></div>
			<form action="authorization.php" method="POST">
				<input type="text" name="login" required onClick="clearField(this)" onBlur="cursorLeft(this)" value="Логин">
				<input type="password" name="password" required onClick="clearField(this)" onBlur="cursorLeft(this)" value="Пароль">
				<input type="submit" value="">
			</form>
			<div id="footer">
				<p>
					АСУ ТП RR-701-R-T © 2016 <br> Щелбанин Александр, ИУ4-83
				</p>
			</div>
		</div>
	</body>
</html>