
$(document).ready(function () {
    $(".frame-s").click(function () {
        $(".enter").attr("href", $(this).next().val())
        $(".show-date").html($(this).attr("date"))
        $(".show-time").html($(this).val())
        $(".booking-contain").css({ "display": "flex" })
        $("#share").css({ "display": "block" })
    })
})

function clickCancel() {
    var book = document.querySelector(".booking-contain")
    var overlay = document.querySelector("#share")

    overlay.style.display = "none"
    book.style.display = "none"
}