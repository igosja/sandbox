import React, {useEffect, useState} from 'react';
import axios from 'axios';
import MainLayout from "../layout/MainLayout";
import Placeholder from "../../components/placeholder/Placeholder";

function IndexPage() {
    const url = '/api/lunch';
    const [menu, setMenu] = useState([]);
    const fetchData = () => {
        axios
            .get(url, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                }
            })
            .then(data => {
                setMenu([data.data.data]);
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    if (menu.length) {
        return (
            <MainLayout>
                <h1 className="text-center">Меню</h1>
                <div className="row">
                    {Array.from({length: 5}).map((_, index) => (
                        <div className="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                            <table className="table table-bordered table-hover" aria-describedby="header">
                                <thead>
                                <tr>
                                    <th className="text-center">{index}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {Array.from({length: menu.length}).map((_, cIndex) => (
                                    <>
                                        {Array.from({length: menu[cIndex].length}).map((_, dIndex) => (
                                            <tr>
                                                <td>
                                                    {menu[cIndex][dIndex][index]}
                                                </td>
                                            </tr>
                                        ))}
                                    </>
                                ))}
                                </tbody>
                            </table>
                        </div>
                    ))}
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
