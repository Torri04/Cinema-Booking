$(document).ready(function () {
    let i_n = 0;
    let i_m = 0;

    $(".clickAdd-1").click(function () {
        $(`<div class='ctn-show'>
              <input name=show_n[${i_n}] type='text' class='frame-s ipt'>
              <span onclick='clickVirShow(this)' style='display: flex' class='show-dlt'>-</span>
           </div>`).insertBefore($(this))
        i_n++;
    })
    $(".clickAdd-2").click(function () {
        $(`<div class='ctn-show'>
        <input name=show_m[${i_m}] type='text' class='frame-s ipt'>
        <span onclick='clickVirShow(this)' style='display: flex' class='show-dlt'>-</span>
     </div>`).insertBefore($(this))
        i_m++;
    })
})
function clickVirShow(e) {
    e.parentNode.remove()
}
function clickDeleteShow(e) {
    e.parentNode.remove()
    //<input id="deletedShow" name="deletedShow" hidden type="text">
}
$(document).ready(function () {
    let i = 0;
    $(".show-dlt").click(function () {
        $(`<input name=deletedShow[${i}] hidden type="text" value=${$(this).siblings().attr("key")}>`).insertAfter($(this).parent())
        $(this).parent().remove();
        i++;
    })
})

//show edit
function clickEdit(e) {
    var save = document.querySelector(".save")
    var cancle = document.querySelector(".cancle")

    e.style.display = "none"
    save.style.display = "block"
    cancle.style.display = "block"

    const nonable = document.querySelectorAll(".unable")
    for (let i of nonable) {
        i.classList.remove("unable")
    }

    const text = document.querySelectorAll(".txtare")
    for (let i of text) {
        i.removeAttribute("disabled")
    }

    const clickAdd_1 = document.querySelector(".clickAdd-1")
    clickAdd_1.classList.remove("isShow")
    const clickAdd_2 = document.querySelector(".clickAdd-2")
    clickAdd_2.classList.remove("isShow")

    const trailer = document.querySelector(".trailer")
    trailer.style.display = "none"

    const dltBtn = document.querySelectorAll(".show-dlt")
    for (let i of dltBtn) {
        i.style.display = "flex"
    }
}