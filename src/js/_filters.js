export default () => 
document.querySelectorAll("[data-togglable]").forEach(filter => {

    const toggle = filter.querySelector(".course-filter__toggle")
    const body = filter.querySelector(".course-filter__body")

    toggle.addEventListener("click", e => {
        e.preventDefault()
        if(body.getAttribute("hidden")){
            toggle.setAttribute("aria-expanded", "true")
            body.removeAttribute("hidden")
        } else {
            toggle.setAttribute("aria-expanded", "false")
            body.setAttribute("hidden", "true")
        }
    })

})