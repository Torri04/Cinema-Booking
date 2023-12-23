
$(document).ready(function () {
    $(".delete").click(function () {
        $(".dele-contain").css({ "display": "flex" })
        $("#share").css({ "display": "block" })
    })
})


function clickCancel() {
    var dele = document.querySelector(".dele-contain")
    var overlay = document.querySelector("#share")

    overlay.style.display = "none"
    dele.style.display = "none"
}