//show edit
function clickEdit(e) {
    var save = document.querySelector(".save")
    var cancle = document.querySelector(".cancle")
    var img = document.querySelector(".ava-btn")

    e.style.display = "none"
    save.style.display = "block"
    cancle.style.display = "block"
    img.style.display = "flex"

    const nonable = document.querySelectorAll(".unable")
    for (let i of nonable) {
        i.classList.remove("unable")
    }

    const text = document.querySelectorAll("#address")
    for (let i of text) {
        i.removeAttribute("disabled")
    }
}