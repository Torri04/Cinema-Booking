$(document).ready(function () {
    $('.a-sw').filter(function () {
        if (location.href.includes("film") && this.href.includes("film"))
            return true;
        return location.href === this.href;
    }).addClass('isActive');
});