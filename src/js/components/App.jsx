import React, { useState } from "react"
import { Formik, Form } from "formik"
import * as Yup from "yup"
import fetch from "unfetch"
import Field from "./Field"

const endpoint = "https://hackney-opportunities-staging.herokuapp.com/api/v1/course_applications"

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
    phone_number: Yup.number("Please give a valid phone number"),
    live_in_hackney: Yup.bool()
        .oneOf([true], "Our courses are only for Hackney residents")
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
                live_in_hackney: false
            }}
            validationSchema={schema}
            onSubmit={async values => {
                try{
                    setProcessing(true)
                    // const res = await fetch(endpoint, {
                    //     method: "post",
                    //     headers: {
                    //       'Content-Type': 'application/json'
                    //     },
                    //     body: JSON.stringify({
                    //         course_application: {
                    //             ...values,
                    //             intake_id: __INTAKE_ID__
                    //         }
                    //     })
                    // })
                    // const data = await res.json()
                    // if(res.status === 200) {
                    //     window.location.replace(window.location.href + `/confirmation?recipient=${values.email}`)
                    // } else {
                    //     throw new Error
                    // }

                    setTimeout(() => {
                        window.location.replace(window.location.href + `/confirmation?recipient=${values.email}`)
                    }, 1000)
                } catch(e){
                    setProcessing(false)
                    setGlobalError(true)
                }
            }}
        >
            {({errors, touched}) =>
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
                        hint="We'll use this to send you text updates about your application"
                        errors={touched.phone_number ? errors.phone_number : null} 
                    />

                    <Field 
                        type="checkbox" 
                        label="I am a Hackney resident" 
                        name="live_in_hackney"
                        errors={touched.live_in_hackney ? errors.live_in_hackney : null} 
                    />

                    <p className="apply-form__guidance">Once you submit this application it will be reviewed by the team and you will be contacted about joining the course and what to do next. </p>

                    <button 
                        className={processing ? "apply-form__button apply-form__button--processing" : "apply-form__button"}
                        disabled={processing ? true : false}
                    >
                        Finish & Apply
                    </button>
                    {globalError && <p className="apply-form__error">There was an error send your application. Please refresh the page and try again, or contact us if the problem continues.</p>}
                </Form>
            }
        </Formik>
    )
}

export default App