import React from "react"

const FileField = ({
    label,
    name,
    hint,
    errors,
    setFieldValue
}) =>
    <div className="apply-form__field">
        <label htmlFor="cv">
            Upload a CV
        </label>
        <input
            type="file"
            name={name} 
            id="cv"
            onChange={e => {
                setFieldValue("cv", e.currentTarget.files[0])
            }}
            aria-required="true"
            aria-invalid={!!errors}
            aria-describedby={`${name}-errors`}
        />
        {hint && <p className="apply-form__hint">{hint}</p>}
        {errors && <p className="apply-form__error" id={`${name}-errors`}>{errors}</p>}
    </div>
        

export default FileField