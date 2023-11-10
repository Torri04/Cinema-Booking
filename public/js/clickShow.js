$(document).ready(function () {
    $('.datee').filter(function () {
        return location.href === this.href;
    }).addClass('isOnShow');
});