<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body id="full-screen-background-image">
		<div class="container">
        <div class="card card-container">
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email">Usuario</span>
                <input type="email" id="inputEmail" class="form-control" placeholder="" required autofocus>
		            <span id="reauth-email" class="reauth-email">Contraseña</span>
                <input type="password" id="inputPassword" class="form-control" placeholder="" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Olvidaste tu contraseña?
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
	</body>
</html>
<style media="screen">
@import url(http://fonts.googleapis.com/css?family=Roboto);
/*
 * Specific styles of signin component
 */
/*
 * General styles
 */
body, html {
    height: 100%;
    background-repeat: no-repeat;
    background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
		background: url(images/fondo-login.png);
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-repeat: no-repeat;
		background-position: center center;
		background-attachment: fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
}
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}
.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}
/*
 * Card component
 */
.card {
    background-color: #663399;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    -moz-box-shadow: 10px 10px 0px #333366;
    -webkit-box-shadow: 10px 10px 0px #333366;
    box-shadow: 10px 10px 0px #333366;
}
.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 10%;
    -webkit-border-radius: 10%;
    border-radius: 10%;
}
/*
 * Form styles
 */
.profile-name-card {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}
.reauth-email {
    display: block;
    color: #FFF;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 20px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}
.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus {
    border-color: #fff;
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
.btn.btn-signin {
    background-color: #333366;
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: 2;
		border-color: #fff;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}
.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}
.forgot-password {
    color: rgb(104, 145, 162);
		font-size: 20px;
}
.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: #fff;
}
</style>
