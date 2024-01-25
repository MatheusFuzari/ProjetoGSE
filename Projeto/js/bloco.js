let blocoA = document.getElementById('blocoa')
let blocoB = document.getElementById('blocob')
let texto = document.getElementById('desaparece-aparece')
blocoA.style.display = 'none'
blocoB.style.display = 'none'
function SelBloco(blocos) {
  if (blocos == 'A') {
    blocoA.style.display = 'block'
  } else {
    blocoA.style.display = 'none'
  }

  if (blocos == 'B') {
    blocoB.style.display = 'block'
  } else {
    blocoB.style.display = 'none'
  }
}

function reservas(a, b) {
  let reserva = document.getElementById('Reservar' + a + b)
  let lista = document.getElementById('ListaReserva' + a + b)
  let astro = document.getElementById('astroModal' + a + b)
  let sr = document.getElementById('sobreReserva' + a + b)
  reserva.style.display = 'block'
  lista.style.display = 'none'
  astro.style.display = 'block'
  sr.style.display = 'none'
}

function listaReserva(a, b) {
  let reserva = document.getElementById('Reservar' + a + b)
  let lista = document.getElementById('ListaReserva' + a + b)
  let astro = document.getElementById('astroModal' + a + b)
  let sr = document.getElementById('sobreReserva' + a + b)
  console.log(a, b)
  reserva.style.display = 'none'
  lista.style.display = 'block'
  astro.style.display = 'none'
  sr.style.display = 'none'
}

function sobrereservas(a, b) {
  let reserva = document.getElementById('Reservar' + a + b)
  let lista = document.getElementById('ListaReserva' + a + b)
  let astro = document.getElementById('astroModal' + a + b)
  let sr = document.getElementById('sobreReserva' + a + b)
  sr.style.display = 'block'
  reserva.style.display = 'none'
  lista.style.display = 'none'
  astro.style.display = 'none'
}

document.addEventListener('keydown', e => {
  let keyName = e.key
  console.log(keyName)
  if (keyName == 'F5') {
    location.replace('menu.php')
  }
})
