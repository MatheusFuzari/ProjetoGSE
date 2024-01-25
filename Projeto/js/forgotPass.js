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
  let url = window.location.search
  let params = new URLSearchParams(url)
  let id = parseInt(params.get('id'))
  const forms = document.getElementById('forms')
  forms.setAttribute(
    'action',
    '../../../FuzariBackend/public/updateSenha.php?id=' + id
  )
}
