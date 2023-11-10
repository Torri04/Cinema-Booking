const img = document.querySelectorAll(".imgs")
const input = document.querySelectorAll(".ins-ipt")
const rdl = document.querySelectorAll(".rdl")
const file = document.querySelectorAll(".ins")
const rdl_img = document.querySelectorAll(".rdl-img")

for (let i = 0; i < img.length; i++) {
    input[i].addEventListener("change", function () {
        let imgLink = URL.createObjectURL(input[i].files[0]);

        file[i].style.backgroundColor = "transparent"

        img[i].src = `${imgLink}`;

        rdl[i].style.display = "none";
    })

    file[i].addEventListener("dragover", function (e) {
        e.preventDefault();
        rdl_img[i].style.transform = "scale(1.1)"

    })

    file[i].addEventListener("dragleave", function (e) {
        e.preventDefault();
        rdl_img[i].style.transform = "scale(1)"
    })

    file[i].addEventListener("drop", function (e) {
        e.preventDefault();
        input[i].files = e.dataTransfer.files;

        let imgLink = URL.createObjectURL(input[i].files[0]);
        file[i].style.backgroundColor = "transparent"
        img[i].src = `${imgLink}`;
        rdl[i].style.display = "none";
    })
}


