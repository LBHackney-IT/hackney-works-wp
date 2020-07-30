import initTestimonials from "./_testimonials"
import initFilters from "./_filters"


// polyfill foreach
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach
}

document.addEventListener("DOMContentLoaded", () => {
    initTestimonials()
    initFilters()
})