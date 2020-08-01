import React from "react"
import { Field } from "formik"

const FlexibleField = ({
    name,
    id,
    label,
    className,
    type,
    errors,
    optional,
    ...props
}) =>
    type === "checkbox" ?
        <div className="apply-form__field apply-form__field--checkbox">
            <Field type={type} name={name} id={id || name} {...props}/>
            <label htmlFor={id || name}>{label}</label>
            {errors && <p className="apply-form__error">{errors}</p>}
        </div>
        :
        <div className="apply-form__field">
            <label htmlFor={id || name}>
                {label}
                {optional && <span className="apply-form__optional">Optional</span>}
            </label>
            <Field type={type} name={name} id={id || name} {...props}/>
            {errors && <p className="apply-form__error">{errors}</p>}
        </div>
        

export default FlexibleField