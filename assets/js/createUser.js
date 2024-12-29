const emailInput = document.querySelector('#email')
const nomeInput = document.querySelector('#nome')
const senhaInput = document.querySelector('#senha')
const confirme = document.querySelector('#confirme')
const telefoneInput = document.querySelector('#telefone')
const funcaoInput = document.querySelector('#funcao')

const campos = document.querySelectorAll(".required")
const span = document.querySelectorAll(".span-required")

const regrasValidacao = [
    (valor) => /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(valor),
    (valor) => /\s/.test(valor),
    (valor) => valor.length > 7,
    (valor, campos) => valor === campos[2].value,
    (valor) => valor.length > 11,
]

campos.forEach((campo, index) => {
    campo.addEventListener("input", (e) => {
        const valor = e.target.value
        const valido = regrasValidacao[index](valor, campos)
        valido ? removaErro(index) : atualizeErro(index)
    })
})

telefoneInput.addEventListener('input', () => {
    let value = telefoneInput.value.replace(/\D/g, '') // Remove tudo que não for número

    if (value.length > 11) {
        value = value.slice(0, 11) // Limita ao máximo de 11 dígitos
    }

    // Formata o valor conforme os dígitos
    if (value.length > 10) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2, 7)}-${value.slice(7)}`
    } else if (value.length > 6) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2, 6)}-${value.slice(6)}`
    } else if (value.length > 2) {
        telefoneInput.value = `(${value.slice(0, 2)})${value.slice(2)}`
    } else {
        telefoneInput.value = value
    }
})

form.addEventListener("submit", (e) => {
    e.preventDefault()

    const valido = Array.from(campos).every((campo, index) => {
        const valor = campo.value
        return regrasValidacao[index](valor, e.target)
    })


    if (valido && preview.src != window.location.href) {
        console.log("Foi")
        form.submit();
    } else {
        console.log("Não foi")
        dropLabel.classList.add("null")
    }
})

function atualizeErro(index) {
    campos[index].style.borderColor = "var(--color-dark-red)"
    span[index].style.display = "block"
}

function removaErro(index) {
    campos[index].style.borderColor = "var(--color-dark-green)"
    span[index].style.display = "none"
}