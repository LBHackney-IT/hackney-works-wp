export default () => 
document.querySelectorAll("[data-tabs]").forEach(filter => {

    const tabs = filter.querySelectorAll(".intake-tabs__link")
    const tabpanels = filter.querySelectorAll(".intake-tabs__tabpanel")

    tabs.forEach((tab, i) => {
        tab.addEventListener("click", e => {

            e.preventDefault()

            tabs.forEach(tab => tab.setAttribute("aria-selected", "false"))
            tab.setAttribute("aria-selected", "true")
            
            tabpanels.forEach(tab => tab.setAttribute("hidden", "true"))
            tabpanels[i].removeAttribute("hidden")

        })
    })
})