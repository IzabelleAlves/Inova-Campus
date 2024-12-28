const telefoneInput = document.getElementById('telefone');

telefoneInput.addEventListener('input', (event) => {
    let value = telefoneInput.value.replace(/\D/g, ''); // Remove tudo que não for número

    if (value.length > 11) {
        value = value.slice(0, 11); // Limita ao máximo de 11 dígitos
    }

    // Formata o valor conforme os dígitos
    if (value.length > 10) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2, 7)}-${value.slice(7)}`;
    } else if (value.length > 6) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2, 6)}-${value.slice(6)}`;
    } else if (value.length > 2) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2)}`;
    } else {
        telefoneInput.value = value;
    }
});