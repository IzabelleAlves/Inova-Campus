const form = document.querySelector("#form")
const emailInput = document.querySelector('#email')
const nomeInput = document.querySelector('#nome')
const senhaInput = document.querySelector('#senha')
const confirmeInput = document.querySelector('#confirme')
const telefoneInput = document.querySelector('#telefone')
const funcao = document.querySelector('#funcao')

const campos = document.querySelectorAll(".required")
const span = document.querySelectorAll(".span-required")
const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
const nomeRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ'-]{2,30}(\s+[A-Za-zÀ-ÖØ-öø-ÿ'-]{2,30})+$/

emailInput.addEventListener("input", emailValidate)
nomeInput.addEventListener("input", nameValidate)
senhaInput.addEventListener("input", passwordValidate)
confirmeInput.addEventListener("input", comparePassword)
telefoneInput.addEventListener("input", telefoneValidate)

form.addEventListener("submit", (e) => {
    let valido = true
    e.preventDefault()
    if (!emailValidate()) valido = false
    if (!nameValidate()) valido = false
    if (!passwordValidate()) valido = false
    if (!comparePassword()) valido = false

    if (valido) form.submit()
})

telefoneInput.addEventListener('input', () => {
    let value = telefone.value.replace(/\D/g, '') // Remove tudo que não for número

    if (value.length > 11) {
        value = value.slice(0, 11) // Limita ao máximo de 11 dígitos
    }

    // Formata o valor conforme os dígitos
    if (value.length > 10) {
        telefone.value = `(${value.slice(0, 2)})${value.slice(2, 7)}-${value.slice(7)}`
    } else if (value.length > 6) {
        telefone.value = `(${value.slice(0, 2)})${value.slice(2, 6)}-${value.slice(6)}`
    } else if (value.length > 2) {
        telefone.value = `(${value.slice(0, 2)})${value.slice(2)}`
    } else {
        telefone.value = value
    }
})

function setError(index) {
    campos[index].style.borderColor = "var(--color-dark-red)"
    span[index].style.display = "inline-block"
}

function removaErro(index) {
    campos[index].style.borderColor = "var(--color-dark-green)"
    span[index].style.display = "none"
}


function emailValidate() {
    const emailValue = emailInput.value.trim()
    if (!emailRegex.test(emailValue.trim())) {
        setError(0)
        return false
    } else {
        removaErro(0)
        return true
    }
}

 function nameValidate() {
    const nomelValue = nomeInput.value.trim()
    if (!nomeRegex.test(nomelValue)) { 
        setError(1)
        return false
    } else {
        removaErro(1)
        return true
    }
}

function passwordValidate() {
    const senhalValue = senhaInput.value.trim()
    if (senhalValue.length < 8) {
        setError(2)
        return false
    } else {
        removaErro(2)
        comparePassword()
        return true
    }
}

function comparePassword() {
    const compare = confirmeInput.value.trim()
    if (senhaInput.value.trim() !== compare) {
        setError(3)
        return false
    } else {
        removaErro(3)
        return true
    }
}

function telefoneValidate() {
    const telValue = telefoneInput.value.trim()
    if (telValue.length <= 12) {
        setError(4)
        return false
    } else {
        removaErro(4)
        return true
    }
}