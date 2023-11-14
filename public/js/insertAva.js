window.addEventListener("load", (event) => {
    const img = document.querySelector(".avt-img")
    const input = document.querySelector("#insertAvt")
    const file = document.querySelector(".ava-btn")

    input.addEventListener("change", function () {
        let imgLink = URL.createObjectURL(input.files[0]);
        img.src = `${imgLink}`;

    })
});


