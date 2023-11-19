
$(document).ready(function () {
    $(".out-icon").click(function () {
        $(".signout-contain").css({ "display": "flex" })
        $("#share").css({ "display": "block" })
    })
})

function clickCancelSignout() {
    var dele = document.querySelector(".signout-contain")
    var overlay = document.querySelector("#share")

    overlay.style.display = "none"
    dele.style.display = "none"
}
