$(document).ready(function () {
    let oldPrice = parseFloat($("#total-money").val().replaceAll(".", ""))

    $(".ipt-pay").change(function () {
        if ($(this).is(":checked")) {
            var check = $(this)

            $(".ipt-pay:checked").each(function () {
                if (check.attr("name") !== $(this).attr("name")) {
                    $(this).prop("checked", false)
                }

            })
        }
    })

    $(".vc-member1").change(function () {
        if ($(this).is(":checked")) {
            $("#voucher").val(`-${$(".vc-value").val()} %`)
        }
        else {
            $("#voucher").val(`-0 %`)
        }
        $("#total-money").val(((oldPrice * (100 - (-parseFloat($("#voucher").val().replaceAll(".", "")))) / 100) - (-parseFloat($("#points").val().replaceAll(".", "")))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'))
    })

    $(".type").change(function () {
        if (parseInt($(this).val()) > parseInt($(".point").text()))
            $(this).val($(".point").text())

        $(".cash-dec").html(`= ${(parseFloat(($(this).val() === "") ? 0 : $(this).val()) * 1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')} VNĐ`)

        $("#points").val(`-${(parseFloat(($(this).val() === "") ? 0 : $(this).val()) * 1000).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`)

        $("#total-money").val((parseFloat($("#total-money").val().replaceAll(".", "")) - (parseFloat(($(this).val() === "") ? 0 : $(this).val()) * 1000)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'))

        $("#total-money").val(((oldPrice * (100 - (-parseFloat($("#voucher").val().replaceAll(".", "")))) / 100) - (-parseFloat($("#points").val().replaceAll(".", "")))).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'))
    })

})