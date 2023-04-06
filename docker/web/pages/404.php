<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Error 404 - Page not found</title>
		
		<meta name="description" content="Erreur 404. La page que vous cherchez est introuvable.." />
		<meta name="keywords" content="404, erreur, page, introuvable" />
		<meta name="verify-v1" content="zMT4mJQ0NVhgU9zMKQFq7VBHhV8vkaui/Ed5n6X4axo=" />

		<style>
			html {
				height: 100%;
			}
			body {
			background: radial-gradient(rgba(0,0,0,0), rgba(0,0,0,0.6)), linear-gradient(#EEE, #FFF, #FFF, #999);
			}

			h1 {
			text-align:center;
				margin-top: 4em;
			  font-size: 48px;
			  font-weight: normal;
			  padding: 0px 20px 5px;
			  border: 2px solid #222222;
			  display: inline-block;
			}

			.theme {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				perspective: 1000px;
			}
			.theme .head {
				width: 200px;
				height: 250px;
				background: rgb(204, 153, 153);
				border-radius: 60% 60% 60% 60% / 60% 60% 50% 50%;
				transform: rotateX(40deg);
				border: 15px solid #000;
				position: relative;
				overflow: hidden;
				z-index: 5;
				top: 0px;
				-webkit-animation: headshake 5s linear 1.5s infinite;
				animation: headshake 5s linear 1.5s infinite;
			}
			.theme .head .eyes div {
				width: 50px;
				height: 60px;
				background: black;
				border-radius: 50%;
				position: absolute;
				top: 100px;
				left: 15px;
			}
			.theme .head .eyes div:nth-child(2) {
				left: auto;
				right: 15px;
			}
			.theme .head .eyes div:after {
				position: absolute;
				content: "";
				height: 120px;
				width: 90%;
				top: 30px;
				left: 5%;
				background: rgb(154, 199, 203);
				background: repeating-linear-gradient( 0deg, rgb(166, 206, 210), rgb(166, 206, 210) 0px, rgb(154, 199, 203) 20px, rgb(154, 199, 203) 40px );
				z-index: -1;
				-webkit-animation: eyedrops 1s linear 0s infinite;
				animation: eyedrops 1s linear 0s infinite;
			}
			.theme .head .eyes div:before {
				content: "";
				width: 35%;
				height: 35%;
				background: white;
				position: absolute;
				top: 10px;
				left: 10px;
				border-radius: 50%;
				-webkit-animation: shake 0.15s linear 0s infinite;
				animation: shake 0.15s linear 0s infinite;
			}
			.theme .head .mouth {
				height: 45px;
				width: 90px;
				border-radius: 90px 90px 15px 15px;
				background: black;
				transform: scale(0.64) scaleY(1.4);
				position: absolute;
				bottom: 65px;
				left: 55px;
				-webkit-animation: mouth 5s linear 1.5s infinite;
				animation: mouth 5s linear 1.5s infinite;
			}
			.theme .head .mouth:after {
				width: 80%;
				left: 10%;
				height: 8px;
				border-radius: 10px 10px 3px 3px;
				background: white;
				content: "";
				position: absolute;
				bottom: 8px;
			}
			.theme .body {
				background: rgb(204, 153, 153);
				z-index: 1;
				width: 90px;
				height: 60px;
				border-radius: 10px;
				position: relative;
				top: -70px;
				left: 55px;
				border: 13px solid #000;
			}

			.theme .body:after, .theme .body:before {
				background: rgb(204, 153, 153);
				border: 10px solid #000;
				border-left-width: 13px;
				content: "";
				width: 32%;
				left: -13px;
				height: 30px;
				position: absolute;
				border-radius: 10px;
				bottom: -40px;
				border-top: transparent;
			}
			.theme .body:after {
				border-width: 10px;
				border-right-width: 13px;
				right: -13px;
				left: auto;
			}
			.theme .body .hands {
				position: relative;
			}
			.theme .body .hands:after, .theme .body .hands:before {
				content: "";
				width: 15px;
				height: 40px;
				background: rgb(204, 153, 153);
				border: 10px solid #000;
				border-right-width: 5px;
				border-left-width: 15px;
				border-radius: 0px 0px 0px 30px;
				position: absolute;
				left: -38px;
				top: -10px;
				transform: rotate(5deg);
			}
			.theme .body .hands:after {
				border-radius: 0px 0px 30px 0px;
				transform: rotate(-5deg);
				right: -38px;
				left: auto;
				border-left-width: 5px;
				border-right-width: 15px;
			}
			.shadow {
				width: 200px;
				height: 50px;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				margin-top: 140px;
				position: absolute;
				background: rgba(0,0,0,0.2);
				border-radius: 50%;
				z-index: -1;
			}

			/*Copyright*/

			p {
				font-family: Segoe UI;
				color: black;
				font-size: 15px;
				position: absolute;
				text-align: center;
				width: 100%;
				bottom: 5px;
				opacity: 0.5;
				text-shadow: 0px 1px 5px rgba(0,0,0,0.4);
				transition-duration: 0.3s;
				cursor: default;
				left: 0;
			}
			p:hover { opacity: 1; }
			p a {
				text-decoration: none;
				transition-duration: 0.3s;
				opacity: 0.8;
			}
			p a:hover {
				opacity: 1;
			}
			p span:nth-of-type(1){
				color: rgb(237, 117, 117);
				font-weight: bold;
			}
			p span:nth-of-type(2){
				color: rgb(237, 117, 117);
			}
			p span:nth-of-type(3){
				font-weight: bold;
			}

			@-webkit-keyframes eyedrops {
				100% { background-position: 0 40px; }
			}
			@keyframes eyedrops {
				100% { background-position: 0 40px; }
			}

			@-webkit-keyframes shake {
				50% { left: 8px; }
			}
			@keyframes shake {
				50% { left: 8px; }
			}

			@-webkit-keyframes headshake {
				40% { top: 0px; }
				50% { top: 8px; }
				80% { top: 8px; }
				90% { top: 0px; }
			}
			@keyframes headshake {
				50% { top: 0px; }
				50% { top: 8px; }
				80% { top: 8px; }
				90% { top: 0px; }
			}

			@-webkit-keyframes mouth {
				40% { height: 45px; bottom: 65px }
				50% { height: 60px; bottom: 50px }
				80% { height: 60px; bottom: 50px }
				90% { height: 45px; bottom: 65px }
			}
			@keyframes mouth {
				40% { height: 45px; bottom: 65px }
				50% { height: 60px; bottom: 50px }
				80% { height: 60px; bottom: 50px }
				90% { height: 45px; bottom: 65px }
			}
		</style>
	</head>
	<body>	
		<center><h1>Error 404</h1></center>
		<div class="theme">
			<div class="head">
				<div class="eyes">
					<div></div>
					<div></div>
				</div>
				<div class="mouth"></div>
			</div>
			<div class="body">
				<div class="hands"></div>
			</div>
		</div>
		<div class="shadow"></div>
	</body>
</html>