document.getElementById("phone").addEventListener("input", function (e) {
  let num = e.target.value.replace(/\D/g, ""); // Remove tudo que não for número

  if (num.length > 11) num = num.slice(0, 11); // Limita a 11 dígitos

  let formatted = "";
  if (num.length > 10) {
    formatted = `(${num.slice(0, 2)}) ${num.slice(2, 7)}-${num.slice(7)}`;
  } else if (num.length > 6) {
    formatted = `(${num.slice(0, 2)}) ${num.slice(2, 6)}-${num.slice(6)}`;
  } else if (num.length > 2) {
    formatted = `(${num.slice(0, 2)}) ${num.slice(2)}`;
  } else if (num.length > 0) {
    formatted = `(${num}`;
  }

  e.target.value = formatted;
});
