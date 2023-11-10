import React, {useEffect, useState} from 'react';
import axios from 'axios';
import {Link, useParams} from "react-router-dom";
import MainLayout from "../../layout/MainLayout";

function ViewPage() {
    const url = '/api/lunch/dishes/';
    const [dish, setDish] = useState({
        id: '',
        category_id: 0,
        created_at: '',
        is_active: 0,
        is_favorite: 0,
        is_ordered: 0,
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
                setDish(data.data.data)
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <MainLayout>
            <h1 className="text-center" id="header">{dish.name}</h1>
            <ul className="list-inline text-center">
                <li className="list-inline-item">
                    <Link to={'/lunch/dishes'} className="btn btn-default">
                        Список
                    </Link>
                </li>
                <li className="list-inline-item">
                    <Link to={'/lunch/dishes/edit/' + params.id} className="btn btn-default">
                        Змінити
                    </Link>
                </li>
            </ul>
            <div className="row">
                <table className="table table-striped table-bordered detail-view" aria-describedby="header">
                    <tbody>
                    <tr>
                        <th className="col-lg-6">Id</th>
                        <td>{dish.id}</td>
                    </tr>
                    <tr>
                        <th>Назва</th>
                        <td>{dish.name}</td>
                    </tr>
                    <tr>
                        <th>Категорія</th>
                        <td>{dish.category_id}</td>
                    </tr>
                    <tr>
                        <th>Активність</th>
                        <td>{dish.is_active}</td>
                    </tr>
                    <tr>
                        <th>Замовляв</th>
                        <td>{dish.is_ordered}</td>
                    </tr>
                    <tr>
                        <th>Сподобалось</th>
                        <td>{dish.is_favorite}</td>
                    </tr>
                    <tr>
                        <th>Створено</th>
                        <td>{dish.created_at}</td>
                    </tr>
                    <tr>
                        <th>Оновлено</th>
                        <td>{dish.updated_at}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </MainLayout>
    );
}

export default ViewPage;
