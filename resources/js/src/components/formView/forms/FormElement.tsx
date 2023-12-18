import React from 'react';
import Form from "react-bootstrap/Form";
import SubmitButton from "./elements/SubmitButton";
import TextField from "./elements/TextField";

function FormElement({fields, formData, errors, validated, handleSubmit, handleChange}) {
    return (
        <Form noValidate validated={validated} onSubmit={handleSubmit}>
            {fields.map(field => (
                <TextField field={field} formData={formData} errors={errors} handleChange={handleChange}/>
            ))}
            <SubmitButton/>
        </Form>
    );
}

export default React.memo(FormElement);
