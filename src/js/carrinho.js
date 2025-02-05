const prices = { empada: 2.5, coxinha: 3.5, bolo: 10.0 };
const quantities = { empada: 2, coxinha: 2, bolo: 2 };

// Atualizar a quantidade de itens
function updateQuantity(item, change) {
  if (quantities[item] + change >= 0) {
    quantities[item] += change;
    document.getElementById(`${item}-qty`).innerText = quantities[item];
    updateTotal();
  }
}

// Atualizar o total
function updateTotal() {
  const total = Object.keys(quantities).reduce((sum, item) => {
    return sum + quantities[item] * prices[item];
  }, 0);
  document.getElementById('total-price').innerText = total.toFixed(2).replace('.', ',');
}

// Mostrar ou ocultar o menu e ajustar paddingTop
function toggleMenu() {
  const menu = document.getElementById('menu');
  const headerHeight = document.querySelector('header').offsetHeight;
  menu.style.paddingTop = `${headerHeight}px`;
  menu.classList.toggle('visible');
}
