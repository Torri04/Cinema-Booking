window.addEventListener("load", (event) => {
    const img = document.querySelectorAll(".imgs")
    const input = document.querySelectorAll(".ins-ipt")
    const file = document.querySelectorAll(".ins")

    for (let i = 0; i < img.length; i++) {
        input[i].addEventListener("change", function () {
            let imgLink = URL.createObjectURL(input[i].files[0]);

            file[i].style.backgroundColor = "transparent"

            img[i].src = `${imgLink}`;

        })

        file[i].addEventListener("dragover", function (e) {
            e.preventDefault();
        })

        file[i].addEventListener("dragleave", function (e) {
            e.preventDefault();
        })

        file[i].addEventListener("drop", function (e) {
            e.preventDefault();
            input[i].files = e.dataTransfer.files;

            let imgLink = URL.createObjectURL(input[i].files[0]);
            file[i].style.backgroundColor = "transparent"
            img[i].src = `${imgLink}`;
        })
    }



})

