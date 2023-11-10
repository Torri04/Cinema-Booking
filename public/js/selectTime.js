$(document).ready(function () {
    var film;
    var date;

    $('.book').trigger("reset");

    $('.film').change(function () {
        film = $(this).val()

        $('.opt-add').each(function () {
            $(this).remove()
        })

        for (let i of data) {
            if (String(i.MovieID) === film && i.Date === date) {
                $('.timer').append(`<option class='opt opt-add' value=${i.StartTime}>${i.StartTime.slice(0, 5)}</option>`);
            }
        }
    })
    $('.date').change(function () {
        date = $(this).val()

        $('.opt-add').each(function () {
            $(this).remove()
        })

        for (let i of data) {
            if (String(i.MovieID) === film && i.Date === date) {
                $('.timer').append(`<option class='opt opt-add' value=${i.StartTime}>${i.StartTime.slice(0, 5)}</option>`);
            }
        }
    })
})