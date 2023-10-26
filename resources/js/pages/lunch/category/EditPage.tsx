import React, {useEffect, useState} from 'react';
import {Link, useNavigate, useParams} from 'react-router-dom';
import axios from 'axios';
import MainLayout from "../../layout/MainLayout";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";

function EditPage() {
    const navigate = useNavigate();
    const url = '/api/lunch/categories/';
    const [category, setCategory] = useState({
        is_active: 0,
        name: '',
    });
    const [formData, setFormData] = useState({
        is_active: 0,
        name: '',
    });

    const [validated, setValidated] = useState(false);

    const [errors, setErrors] = useState({
        is_active: [],
        name: [],
    });

    const params = useParams();

    const fetchData = () => {
        axios
            .get(url + params.id, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
            })
            .then(data => {
                setCategory(data.data.data)
                setFormData(data.data.data)
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;

        setFormData(values => ({...values, [name]: value}));
    };

    const handleChangeCheckbox = (event) => {
        const name = event.target.name;

        setFormData(values => ({...values, [name]: !values[name]}));
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        event.stopPropagation();

        axios
            .put(url + params.id, formData, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
            })
            .then(() => {
                setErrors({
                    is_active: [],
                    name: [],
                });

                navigate('/lunch/categories/' + params.id, {replace: true});
            })
            .catch(function (error) {
                setErrors({
                    is_active: error.response.data.errors.is_active ?? [],
                    name: error.response.data.errors.name ?? [],
                });
            });

        setValidated(true);
    };

    return (
        <MainLayout>
            <Link to={'/lunch/categories/' + params.id}>
                View
            </Link>

            <h1>{category.name}</h1>

            <Form noValidate validated={validated} onSubmit={handleSubmit}>
                <Form.Group className="mb-3">
                    <Form.Label>Назва</Form.Label>
                    <Form.Control
                        autoFocus
                        type="text"
                        placeholder="Назва"
                        name="name"
                        value={formData.name}
                        onChange={handleChange}
                        isInvalid={!!errors.name.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.name[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <Form.Group className="mb-3">
                    <Form.Check
                        type="checkbox"
                        label="Активна"
                        name="is_active"
                        checked={!!formData.is_active}
                        onChange={handleChangeCheckbox}
                        isInvalid={!!errors.is_active.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.is_active[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <Button type="submit">
                    Зберегти
                </Button>
            </Form>
        </MainLayout>
    );
}

export default EditPage;
