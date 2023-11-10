//show edit
function clickEdit(e) {
    var save = document.querySelector(".save")
    var cancle = document.querySelector(".cancle")

    e.style.display = "none"
    save.style.display = "block"
    cancle.style.display = "block"

    const nonable = document.querySelectorAll(".unable")
    for (let i of nonable) {
        i.classList.remove("unable")
    }

    const text = document.querySelectorAll(".txtare")
    for (let i of text) {
        i.removeAttribute("disabled")
    }

    const trailer = document.querySelector(".trailer")
    trailer.style.display = "none"

    const checkShow = document.querySelector(".checkShow")
    checkShow.style.display = "flex"
}