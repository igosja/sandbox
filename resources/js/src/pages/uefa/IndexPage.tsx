import React, {useEffect, useState} from 'react';
import axios from 'axios';
import MainLayout from "../layout/MainLayout";
import Placeholder from "../../components/placeholder/Placeholder";

function IndexPage() {
    const url = '/api/uefa';
    const [countries, setCountries] = useState([]);
    const fetchData = () => {
        axios
            .get(url, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
            })
            .then(data => {
                setCountries(data.data.data);
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    if (countries.length) {
        return (
            <MainLayout>
                <h1 className="text-center">Таблиця коефіцієнтів UEFA (поточний сезон)</h1>
                <div className="row">
                    <div id="w0" className="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table className="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th className="col-lg-1 text-center">
                                    #
                                </th>
                                <th className="text-center">
                                    Країна
                                </th>
                                <th className="text-center">
                                    Рейтинг
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            {countries.map(({name, rating}, index) => (
                                <tr key={index}>
                                    <td className="text-center">{index + 1}</td>
                                    <td>{name}</td>
                                    <td className="text-center">{rating}</td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </MainLayout>
        );
    } else {
        return (
            <Placeholder/>
        );
    }
}

export default IndexPage;
