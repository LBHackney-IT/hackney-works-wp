import "regenerator-runtime/runtime"
import "react-app-polyfill/ie11"

import "@fortawesome/fontawesome-free/js/all.js"

import initTestimonials from "./_testimonials"
import initFilters from "./_filters"
import initTabs from "./_tabs"

// react deps
import React from "react"
import { render } from "react-dom"
import CourseForm from "./components/CourseForm"
import VacancyForm from "./components/VacancyForm"

// polyfill foreach
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = Array.prototype.forEach
}

document.addEventListener("DOMContentLoaded", () => {
    initTestimonials()
    initFilters()
    initTabs()

    // mount react apps
    const courseRoot = document.querySelector("[data-course-form]")
    if(courseRoot) render(<CourseForm/>, courseRoot)

    const vacancyRoot = document.querySelector("[data-vacancy-form]")
    if(vacancyRoot) render(<VacancyForm/>, vacancyRoot)
})