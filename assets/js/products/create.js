// Função de escolher imagem
const form = document.querySelector("#form")
const dropLabel = document.querySelector("#drop-label")
const fileInput = document.querySelector("#file-input")
const preview = document.querySelector("#preview")
const removeBtn = document.querySelector("#remove-btn")
const dropText = document.querySelector("#drop-text")

const campos = document.querySelectorAll(".required")
const span = document.querySelectorAll(".span-required")

dropLabel.addEventListener("dragover", (e) => {
    e.preventDefault()
    dropLabel.classList.add("dragover")
})

dropLabel.addEventListener("dragleave", () => {
    dropLabel.classList.remove("dragover")
})

dropLabel.addEventListener("drop", (e) => {
    e.preventDefault()
    dropLabel.classList.remove("dragover")

    const file = e.dataTransfer.files[0]
    handleFile(file)
})

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0]
    handleFile(file)
})

removeBtn.addEventListener("click", () => {
    preview.src = ""
    preview.style.display = "none"
    removeBtn.style.display = "none"
    dropText.style.display = "block"
    fileInput.value = ""
    dropLabel.classList.remove("upload")
})

function handleFile(file) {
    if (file && file.type.startsWith("image/")) {
        const reader = new FileReader()
        reader.onload = (e) => {
            preview.src = e.target.result
            preview.style.display = "block"
            removeBtn.style.display = "inline-block"
            dropText.style.display = "none"
            dropLabel.classList.remove("null")
            dropLabel.classList.add("upload")

        }
        reader.readAsDataURL(file)
    } else {
        alert("Por favor, selecione um arquivo de imagem.")
    }
}

// Validar Formulário
const regrasValidacao = [
    (valor) => valor.length >= 3,
    (valor) => valor >= 1,
    (valor) => valor.length >= 3,
]

campos.forEach((campo, index) => {
    campo.addEventListener("input", (e) => {
        const valor = e.target.value
        const valido = regrasValidacao[index](valor, e.target)
        valido ? removaErro(index) : atualizeErro(index)
    })
})

form.addEventListener("submit", (e) => {
    e.preventDefault()

    const valido = Array.from(campos).every((campo, index) => {
        const valor = campo.value
        return regrasValidacao[index](valor, e.target)
    })


    if (valido && preview.src != window.location.href) {
        form.submit();
    } else {
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
