import $ from "jquery"
import "slick-carousel"

export default () => {
    $(".testimonials__list").slick({
        dots: true,
        arrows: false
    })
}   