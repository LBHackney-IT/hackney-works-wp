import $ from "jquery"
import "slick-carousel"

export const initSliders = () => {
    $(".slider").slick({
        dots: true,
        arrows: false
    })
}