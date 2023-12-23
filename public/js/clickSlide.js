$(document).ready(function () {
    let countSl = 0;

    $(".clickL").click(function () {
        if ($(".contain").css("left") !== "0px") {
            $(".contain").animate({
                left: '+=550px',
            }, "slow");
        }
    })

    $(".clickR").click(function () {
        if (countSl <= ($(".each").length - 3)) {
            $(".contain").animate({
                left: '-=550px',
            }, "slow");
            countSl++;
        }
        else {
            $(".contain").animate({
                left: '0px',
            });
            countSl = 0;
        }
    })
})