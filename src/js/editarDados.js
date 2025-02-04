function descartarAlteracoes() {
    document.getElementById('email').value = '';
    document.getElementById('senha').value = '';
    document.getElementById('whatsapp').value = '';
    document.getElementById('tipo-conta').value = '';
    alert("Alterações descartadas!");
}

function salvarAlteracoes() {
    alert("Informações salvas com sucesso!");
}
