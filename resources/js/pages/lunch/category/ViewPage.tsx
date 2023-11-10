import React, {useEffect, useState} from 'react';
import axios from 'axios';
import {Link, useParams} from "react-router-dom";
import MainLayout from "../../layout/MainLayout";

function ViewPage() {
    const url = '/api/lunch/categories/';
    const [category, setCategory] = useState({
        id: '',
        created_at: '',
        is_active: '',
        name: '',
        updated_at: '',
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
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <MainLayout>
            <h1 className="text-center" id="header">{category.name}</h1>
            <ul className="list-inline text-center">
                <li className="list-inline-item">
                    <Link to={'/lunch/categories'} className="btn btn-default">
                        Список
                    </Link>
                </li>
                <li className="list-inline-item">
                    <Link to={'/lunch/categories/edit/' + params.id} className="btn btn-default">
                        Змінити
                    </Link>
                </li>
            </ul>
            <div className="row">
                <table className="table table-striped table-bordered detail-view" aria-describedby="header">
                    <tbody>
                    <tr>
                        <th className="col-lg-6">Id</th>
                        <td>{category.id}</td>
                    </tr>
                    <tr>
                        <th>Назва</th>
                        <td>{category.name}</td>
                    </tr>
                    <tr>
                        <th>Активність</th>
                        <td>{category.is_active}</td>
                    </tr>
                    <tr>
                        <th>Створено</th>
                        <td>{category.created_at}</td>
                    </tr>
                    <tr>
                        <th>Оновлено</th>
                        <td>{category.updated_at}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </MainLayout>
    );
}

export default ViewPage;
