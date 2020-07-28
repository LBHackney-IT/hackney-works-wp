// document.addEventListener("DOMContentLoaded", () => {
//     document.querySelector(".testimonials__list").slick({
//         dots: true,
//         arrows: false
//     })
// })



import $ from "jquery"
import "slick-carousel"

document.addEventListener("DOMContentLoaded", () => {
    $(".testimonials__list").slick({
        dots: true,
        arrows: false
    })
})