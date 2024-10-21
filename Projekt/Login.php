<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./login.stylesheet.css" rel="stylesheet"/> 
    <title>User-Login</title>
</head>
<body id="login-body">
    <div class="background"></div>
        <div class="login-box">
            <h2>Login</h2>
                <form action="./test.html" method="post">
                <div class="textbox">
                    <label>Benutzername<input type="text" placeholder="Benutzername" name="username" required></label>
                </div>
                <div class="textbox">
                    <label>Passwort<input type="password" placeholder="Passwort" name="password" required></label>
                </div>
                    <input type="submit" class="btn" value="Einloggen">
                </form>
        </div>
</body>
</html>