import React, {useEffect, useState} from 'react';
import {Link, useNavigate, useParams} from 'react-router-dom';
import axios from 'axios';
import MainLayout from "../../layout/MainLayout";
import Form from "react-bootstrap/Form";
import Button from "react-bootstrap/Button";

function EditPage() {
    const navigate = useNavigate();
    const url = '/api/lunch/dishes/';
    const urlCategories = '/api/lunch/categories/';
    const [dish, setDish] = useState({
        category_id: 0,
        is_favorite: 0,
        is_ordered: 0,
        name: '',
    });
    const [categories, setCategories] = useState([]);
    const [formData, setFormData] = useState({
        category_id: 0,
        is_favorite: 0,
        is_ordered: 0,
        name: '',
    });

    const [validated, setValidated] = useState(false);

    const [errors, setErrors] = useState({
        category_id: [],
        is_favorite: [],
        is_ordered: [],
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
                setDish(data.data.data)
                setFormData(data.data.data)
            });
    };

    const fetchCategories = () => {
        axios
            .get(urlCategories, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
            })
            .then(data => {
                setCategories(data.data.data)
            });
    };

    useEffect(() => {
        fetchCategories();
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
                    category_id: [],
                    is_favorite: [],
                    is_ordered: [],
                    name: [],
                });

                navigate('/lunch/dishes/' + params.id, {replace: true});
            })
            .catch(function (error) {
                setErrors({
                    category_id: error.response.data.errors.category_id ?? [],
                    is_favorite: error.response.data.errors.is_favorite ?? [],
                    is_ordered: error.response.data.errors.is_ordered ?? [],
                    name: error.response.data.errors.name ?? [],
                });
            });

        setValidated(true);
    };

    return (
        <MainLayout>
            <Link to={'/lunch/dishes/' + params.id}>
                View
            </Link>

            <h1>{dish.name}</h1>

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
                    <Form.Label>Категорія</Form.Label>
                    <Form.Select
                        name="category_id"
                        value={formData.category_id}
                        onChange={handleChange}
                        isInvalid={!!errors.category_id.length}
                    >
                        {categories.map(({id, name}) => (
                            <option value={id} selected={id == dish.category_id}>{name}</option>
                        ))}
                    </Form.Select>
                    <Form.Control.Feedback type="invalid">
                        {errors.category_id[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <Form.Group className="mb-3">
                    <Form.Check
                        type="checkbox"
                        label="Заповляв"
                        name="is_ordered"
                        checked={!!formData.is_ordered}
                        onChange={handleChangeCheckbox}
                        isInvalid={!!errors.is_ordered.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.is_ordered[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <Form.Group className="mb-3">
                    <Form.Check
                        type="checkbox"
                        label="Фаворит"
                        name="is_favorite"
                        checked={!!formData.is_favorite}
                        onChange={handleChangeCheckbox}
                        isInvalid={!!errors.is_favorite.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.is_favorite[0]}
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
