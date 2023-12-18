import React, {useEffect, useState} from 'react';
import {useNavigate, useParams} from "react-router-dom";
import FormElement from "./forms/FormElement";
import axios from "../axios/Axios";
import Header from "./header/Header";
import ButtonList from "./buttonList/ButtonList";
import MainLayout from "../../pages/layout/MainLayout";

function FormView({config}) {
    const initConfig = {
        apiUrl: 'users',
        h1: 'name',
    };
    const currentConfig = {...initConfig, ...config};

    const navigate = useNavigate();
    const [item, setItem] = useState({});
    const [formData, setFormData] = useState({});
    const [validated, setValidated] = useState(false);
    const [errors, setErrors] = useState({});
    const params = useParams();

    let currentPath: string;
    if (params.id) {
        currentPath = window.location.pathname.replace('/edit/' + params.id, '');
    } else {
        currentPath = window.location.pathname.replace('/create', '');
    }

    const fetchData = () => {
        if (params.id) {
            axios
                .get(config.apiUrl + '/' + params.id)
                .then(data => {
                    setItem(data.data.data)
                    setFormData(data.data.data)
                });
        }
    };

    useEffect(() => {
        fetchData();
    }, []);

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;

        setFormData(values => ({...values, [name]: value}));
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        event.stopPropagation();

        if (params.id) {
            axios
                .put(config.apiUrl + '/' + params.id, formData)
                .then(() => {
                    setErrors({});
                    navigate(currentPath + '/' + params.id, {replace: true});
                })
                .catch(function (error) {
                    setErrors(error.response.data.errors);
                });
        } else {
            axios
                .post(config.apiUrl, formData)
                .then(data => {
                    setErrors({});
                    navigate(currentPath + '/' + data.data.data.id, {replace: true});
                })
                .catch(function (error) {
                    setErrors(error.response.data.errors);
                });
        }

        setValidated(true);
    };

    return (
        <MainLayout>
            <Header config={currentConfig} item={item}/>
            <ButtonList/>
            <FormElement
                fields={config.fields}
                formData={formData}
                errors={errors}
                validated={validated}
                handleChange={handleChange}
                handleSubmit={handleSubmit}
            />
        </MainLayout>
    );
}

export default React.memo(FormView);
