function watchTrailer() {
    var frame = document.querySelector(".frame")
    var overlay = document.querySelector("#ovl")

    frame.style.display = "block"
    frame.style.animationName = "frame-in"

    overlay.style.display = "block"
}
function closeClick() {
    var overlay = document.querySelector("#ovl")
    var frame = document.querySelector(".frame")

    frame.style.animationName = "frame-out"
    overlay.style.display = "none"

    document.querySelectorAll('iframe').forEach(v => { v.src = v.src });
}
