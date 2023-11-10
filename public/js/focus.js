function MyFocus1(x) {
    x.nextElementSibling.setAttribute('style', 'transition: 0.3s;font-size: 10px;top: 2px;left: 5px;')
}
function MyFocus2(x) {
    if (!x.value)
        x.nextElementSibling.setAttribute('style', 'transition: 0.3s;top: 25%;left: 10px;font-size:inherited')
}

$(document).ready(function () {
    $(".input").each(function () {
        if ($(this).val())
            MyFocus1(this)
    })
});