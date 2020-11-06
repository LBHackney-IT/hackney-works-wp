import React, { useState } from "react"
import { Formik, Form } from "formik"
import * as Yup from "yup"
import fetch from "unfetch"
import Field from "./Field"
import FileField from "./FileField"

const endpoint = "https://app.opportunities.hackney.gov.uk/api/v1/applications"

const schema = Yup.object().shape({
    first_name: Yup.string()
        .required("Please give a first name")
        .min(2, "First name needs to be at least two letters"),
    last_name: Yup.string()
        .required("Please give a last name")
        .min(2, "Last name needs to be at least two letters"),
    email: Yup.string()
        .required("Please give an email address")
        .email('Please give a valid email address'),
    cv: Yup.mixed(),
    statement: Yup.string()
        .required("Please give a personal statement")
        .min(5, "Your statement is a bit short. Try to write at least a few sentences"),
    phone_number: Yup.number("Please give a valid phone number"),
    live_in_hackney: Yup.bool()
        .oneOf([true], "Our opportunities are for Hackney residents")
})

const App = () => {
    const [processing, setProcessing] = useState(false)
    const [globalError, setGlobalError] = useState(false)

    return(
        <Formik
            initialValues={{
                first_name: "",
                last_name: "",
                email: "",
                phone_number: "",
                cv: "",
                statement: "",
                live_in_hackney: false
            }}
            validationSchema={schema}
            onSubmit={async values => {
                try{
                    setProcessing(true)

                    let formData = new FormData();

                    formData.set("application[type]", "VacancyApplication")
                    formData.set("application[wordpress_object_id]", __VACANCY_ID__)
                    formData.set("application[first_name]", values.first_name)
                    formData.set("application[last_name]", values.last_name)
                    formData.set("application[email]", values.email)
                    formData.set("application[phone_number]", values.phone_number)
                    formData.set("application[cv]", values.cv)
                    formData.set("application[statement]", values.statement)
                    formData.set("application[live_in_hackney]", values.live_in_hackney)
                    
                    const res = await fetch(endpoint, {
                        method: "post",
                        body: formData
                    })
                    const data = await res.json()
                    if(res.status === 200) {
                        window.location.replace(window.location.href + `/confirmation?recipient=${values.email}`)
                    } else {
                        throw new Error
                    }

                } catch(e){
                    setProcessing(false)
                    setGlobalError(true)
                }
            }}
        >
            {({errors, touched, setFieldValue}) =>
                <Form className="apply-form">
                    <Field 
                        label="First name" 
                        name="first_name"
                        errors={touched.first_name ? errors.first_name : null} 
                    />
                    <Field 
                        label="Last name" 
                        name="last_name" 
                        errors={touched.last_name ? errors.last_name : null} 
                    />
                    <Field 
                        label="Email address" 
                        name="email" 
                        errors={touched.email ? errors.email : null} 
                    />
                    <Field 
                        label="Phone number" 
                        name="phone_number" 
                        optional
                        hint="We'll use this to send you updates about your application"
                        errors={touched.phone_number ? errors.phone_number : null} 
                    />
                    <FileField
                        setFieldValue={setFieldValue}
                        optional
                        label="CV" 
                        name="cv"
                        hint="Upload a PDF or Word document"
                        errors={touched.cv ? errors.cv : null} 
                    />
                    <Field 
                        as="textarea"
                        rows="5"
                        label="Why would you be a good fit for this role?" 
                        name="statement" 
                        hint="Write a few paragraphs explaining why your skills and experiences make you suited for this vacancy."
                        errors={touched.statement ? errors.statement : null} 
                    />

                    <Field 
                        type="checkbox" 
                        label="I am a Hackney resident" 
                        name="live_in_hackney"
                        errors={touched.live_in_hackney ? errors.live_in_hackney : null} 
                    />

                    <p className="apply-form__guidance">Once you submit this application it will be reviewed by Hackney employment advisors, who'll be in touch about the next step. </p>

                    <button 
                        className={processing ? "apply-form__button apply-form__button--processing" : "apply-form__button"}
                        disabled={processing ? true : false}
                    >
                        Finish & apply
                    </button>
                    {globalError && <p className="apply-form__error">There was an error sending your application. Please refresh the page and try again, or contact us if the problem continues.</p>}
                </Form>
            }
        </Formik>
    )
}

export default App