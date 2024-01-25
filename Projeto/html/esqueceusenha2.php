<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>GSE</title>
  <link rel="stylesheet" href="../css/login.css" />
  <link rel="icon" href="../img/logo3.png" />
  <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/fontawesome.css" />
  <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/brands.css" />
  <link rel="stylesheet" href="../node_modules/@fortawesome/fontawesome-free/css/solid.css" />
</head>

<body onload="getIdfromurl()">
  <center>
    <form action="" method="post" id="forms">
      <div id="login" class="login">
        <center><img class="logo1" src="../img/logo1.png" /></center>
        <div class="card-content" id='card-content'>
          <div class="card-content-area-user">
            <input class="usuario" type="password" name="pass" autocomplete="off" id="passInput" />
            <span>Nova senha</span>
          </div>
          <i class="fa-regular fa-eye" id="showpass" style="
                position: relative;
                left: 53%;
                top: -2.5rem;
                cursor: pointer;
              " onclick="pass()"></i>
          <div class="card-content-area-password">
            <input class="password" type="password" name="passConfirm" autocomplete="off" id="passInputAgain" />
            <span>Confirmar senha</span>
          </div>
          <i class="fa-regular fa-eye" id="showpassAgain" style="
                position: relative;
                left: 28%;
                top: -2.5rem;
                cursor: pointer;
              " onclick="passAgain()"></i>
        </div>
        <div class="card-footer" id="card-footer">
          <input type="submit" value="Enviar" class="submit" id="btnSend" />
        </div>
      </div>
    </form>
  </center>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>
  <script>
    function pass() {
      const icon = document.getElementById('showpass')
      const password = document.getElementById('passInput')
      if (icon.className == 'fa-regular fa-eye') {
        icon.className = 'fa-regular fa-eye-slash'
        password.setAttribute('type', 'text')
      } else {
        icon.className = 'fa-regular fa-eye'
        password.setAttribute('type', 'password')
      }
    }

    function passAgain() {
      const icon = document.getElementById('showpassAgain')
      const password = document.getElementById('passInputAgain')
      if (icon.className == 'fa-regular fa-eye') {
        icon.className = 'fa-regular fa-eye-slash'
        password.setAttribute('type', 'text')
      } else {
        icon.className = 'fa-regular fa-eye'
        password.setAttribute('type', 'password')
      }
    }

    function getIdfromurl() {
      const url = window.location.search
      const param = new URLSearchParams(url)
      let jwt = param.get('jwt')
      jwt = jwt.replace('.html', '');
      var base64Url = jwt.split('.')[1];
      var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      }).join(''));
      let pacote = JSON.parse(jsonPayload)
      if (Date.now() >= pacote.exp * 1000) {
        document.getElementById('card-content').style.display = "none"
        document.getElementById('card-footer').style.display = "none"

      } else {
        document.getElementById('forms').setAttribute('action', '../public/updateSenha.php?id=' + pacote.id + '.php')
        console.log(Date.now())
        console.log(pacote.exp * 1000)
      }
    }
  </script>
</body>

</html>