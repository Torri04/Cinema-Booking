
$(document).ready(function () {
    $(".film-dele").click(function () {
        $(".dele-contain").css({ "display": "flex" })
        $(".overlay").css({ "display": "block" })

        $(this).parent().find(".title").each(function () {
            $(".dele-contain").find(".title").html(`Bạn có chắc muốn xóa phim "${$(this).html()}"`)
        })

        $(this).parent().each(function () {

            $("#mvID").val(`${$(this).attr("key")}`)
        })
        $(this).parent().parent().each(function () {

            $("#type").val(`${$(this).attr("id")}`)
        })

    })
})


function clickCancel() {
    var dele = document.querySelector(".dele-contain")
    var overlay = document.querySelector(".overlay")

    overlay.style.display = "none"
    dele.style.display = "none"
}