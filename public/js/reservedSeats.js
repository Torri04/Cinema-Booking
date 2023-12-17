function showID() {
    return String(window.location).slice(-36)
}

$(document).ready(function () {
    if ($(".txt").val()) {
        $("#your_seat").val($(".txt").val())
        for (i of $("#your_seat").val().split(", ")) {
            $(`#${i}`).addClass("isSelect")
            $(".price .til").text(`${$(".isSelect").length} x Adult`)
        }
    }
    fetch(`/api/getseat/${showID()}`)
        .then(res => res.json())
        .then(seat => {
            if (seat.length) {
                for (i of seat) {
                    for (y of i.Seat.split(", ")) {
                        $(`#${y}`).each(function () {
                            $(this).html("<img src='http://127.0.0.1:8000/img/icons/close.svg'>")
                            $(this).css({ "background": "#1F293D", "pointer-events": "none" })
                        })
                    }
                }
            }
        })

    $(".ord-sheet").click(function () {
        if ($(this).hasClass("isSelect")) {
            $(this).removeClass("isSelect")

            $("#your_seat").val("")
            $(".txt").val("")

            $(".isSelect").each(function () {
                if ($("#your_seat").val() === "") {
                    $("#your_seat").val(`${$(this).attr('id')}`)
                    $(".txt").val(`${$(this).attr('id')}`)
                }
                else {
                    $("#your_seat").val(`${$("#your_seat").val()}, ${$(this).attr('id')}`)
                    $(".txt").val(`${$(".txt").val()}, ${$(this).attr('id')}`)
                }
            })
            $(".price .til").text(`${$(".isSelect").length} x Adult`)
            $("#total-money").val((parseInt($("#money").val().replaceAll(".", "")) * parseInt($(".isSelect").length)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'))
        }
        else {
            $(this).addClass("isSelect")

            $("#your_seat").val("")
            $(".txt").val("")

            $(".isSelect").each(function () {
                if ($("#your_seat").val() === "") {
                    $("#your_seat").val(`${$(this).attr('id')}`)
                    $(".txt").val(`${$(this).attr('id')}`)
                }
                else {
                    $("#your_seat").val(`${$("#your_seat").val()}, ${$(this).attr('id')}`)
                    $(".txt").val(`${$(".txt").val()}, ${$(this).attr('id')}`)
                }
            })

            $(".price .til").text(`${$(".isSelect").length} x Adult`)
            $("#total-money").val((parseInt($("#money").val().replaceAll(".", "")) * parseInt($(".isSelect").length)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'))
        }
    })
})