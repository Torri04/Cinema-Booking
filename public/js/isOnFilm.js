$(document).ready(function () {
    $('.film-type').filter(function () {
        return location.href === this.href;
    }).addClass('isFilm');
});