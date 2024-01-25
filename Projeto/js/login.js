function testeError() {
  let url = window.location.search
  let params = new URLSearchParams(url)
  let id = params.get('error')
  const body = document.getElementById('body')
  if (id == 'nologin') {
    const myAlert = document.createElement('div')
    myAlert.className = 'ErrorLogin'
    myAlert.id = 'divError'
    const alertContent = document.createTextNode('Login ou senha inválido!')
    myAlert.appendChild(alertContent)
    const afterThis = document.getElementById('login')
    afterThis.parentNode.insertBefore(myAlert, afterThis.nextSibling)
  }else if (id == 'noemail'){
    const myAlert = document.createElement('div')
    myAlert.className = 'ErrorLogin'
    myAlert.id = 'divError'
    const alertContent = document.createTextNode('E-mail inválido para recuperação!')
    myAlert.appendChild(alertContent)
    const afterThis = document.getElementById('login')
    afterThis.parentNode.insertBefore(myAlert, afterThis.nextSibling)
  }else{
    const id = document.getElementById('divError')
    id.remove()
  }
}

document.addEventListener('keydown', e => {
  let keyName = e.key
  if (keyName == 'F5') {
    location.replace('index.html')
  }
})
