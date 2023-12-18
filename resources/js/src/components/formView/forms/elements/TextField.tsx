import React from 'react';
import Form from "react-bootstrap/Form";

function TextField({field, formData, errors, handleChange}) {
    let label = field.charAt(0).toUpperCase() + field.slice(1);
    label = label.replace('_', ' ');

    return (
        <Form.Group className="mb-3">
            <Form.Label>{label}</Form.Label>
            <Form.Control
                type="text"
                placeholder={label}
                name={field}
                value={formData[field]}
                onChange={handleChange}
                isInvalid={!!errors[field]?.length}
            />
            <Form.Control.Feedback type="invalid">
                {errors[field]?.[0]}
            </Form.Control.Feedback>
        </Form.Group>
    );
}

export default React.memo(TextField);
