import React from "react"

const FileField = ({
    label,
    name,
    hint,
    errors,
    optional,
    setFieldValue
}) =>
    <div className="apply-form__field">
        <label htmlFor="cv">
            {label}
            {optional && <span className="apply-form__optional">Optional</span>}
        </label>
        <input
            type="file"
            name={name} 
            id="cv"
            accept=".pdf,.docx,.doc"
            onChange={e => {
                setFieldValue("cv", e.currentTarget.files[0])
            }}
            aria-required={!optional}
            aria-invalid={!!errors}
            aria-describedby={`${name}-errors`}
        />
        {hint && <p className="apply-form__hint">{hint}</p>}
        {errors && <p className="apply-form__error" id={`${name}-errors`}>{errors}</p>}
    </div>
        

export default FileField