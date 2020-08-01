import 'regenerator-runtime/runtime'

import initTestimonials from "./_testimonials"
import initFilters from "./_filters"
import initTabs from "./_tabs"

// react deps
import React from "react"
import { render } from "react-dom"
import App from "./components/App"

// polyfill foreach
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach
}

document.addEventListener("DOMContentLoaded", () => {
    initTestimonials()
    initFilters()
    initTabs()
    // mount react app

    const reactRoot = document.querySelector("[data-apply-form]")
    if(reactRoot) render(<App/>, reactRoot)
})