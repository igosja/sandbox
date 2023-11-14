import React, {useEffect, useState} from 'react';
import axios from 'axios';
import MainLayout from "../../layout/MainLayout";
import {Link, useSearchParams} from "react-router-dom";
import Pagination from "../../../components/Pagination";
import FilterRow from "../../../components/FilterRow";
import SortingRow from "../../../components/SortingRow";

function IndexPage() {
    const url = '/api/lunch/dishes';
    const [dishes, setDishes] = useState([]);
    const [meta, setMeta] = useState({
        from: 1,
        to: 1,
        total: 1,
        links: []
    });
    const [searchParams, setSearchParams] = useSearchParams();
    const fetchData = () => {
        setMeta({
            from: 1,
            to: 1,
            total: 1,
            links: []
        });
        axios
            .get(url + '?page=' + (searchParams.get('page') ?? 1), {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('access_token')}`
                },
                params: {
                    filters: {
                        id: searchParams.get('filters.id'),
                        name: searchParams.get('filters.name'),
                    },
                    sorting: searchParams.get('sorting'),
                    page: searchParams.get('page'),
                },
            })
            .then(data => {
                setDishes(data.data.data)
                setMeta(data.data.meta)
            });
    };

    useEffect(() => {
        fetchData();
    }, [setSearchParams]);

    return (
        <MainLayout>
            <h1 className="text-center">Страви</h1>
            <div className="row">
                <div id="w0" className="col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive">
                    <div className="summary">
                        Показані <b>
                        {meta.from}
                        -
                        {meta.to}
                    </b> із <b>
                        {meta.total}
                    </b> записів.
                    </div>
                    <table className="table table-bordered table-hover">
                        <thead>
                        <SortingRow sorting={[
                            {label: 'ID', name: 'id', empty: false},
                            {label: 'Назва', name: 'name', empty: false},
                            {label: 'Фаворит', name: 'is_favorite', empty: false},
                            {empty: true},
                        ]}/>
                        <FilterRow filters={[
                            {name: 'id', type: 'number'},
                            {name: 'name', type: 'text'},
                            {name: '', type: ''},
                            {name: '', type: ''}
                        ]}/>
                        </thead>
                        <tbody>
                        {dishes.map(({id, is_favorite, is_ordered, name}) => (
                            <tr key={id}>
                                <td className="text-center">{id}</td>
                                <td>{name + (is_ordered ? '' : ' (new)')}</td>
                                <td className="text-center">{is_favorite ? '+' : ''}</td>
                                <td className="text-center">
                                    <Link to={'/lunch/dishes/' + id} title="Переглянути" aria-label="Переглянути">
                                        <svg aria-hidden="true"
                                             style={{
                                                 display: "inline-block",
                                                 fontSize: "inherit",
                                                 height: "1em",
                                                 overflow: "visible",
                                                 verticalAlign: "-.125em",
                                                 width: "1.125em"
                                             }}
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                  d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path>
                                        </svg>
                                    </Link>
                                    &nbsp;
                                    <Link to={'/lunch/dishes/edit/' + id} title="Оновити" aria-label="Оновити">
                                        <svg aria-hidden="true"
                                             style={{
                                                 display: "inline-block",
                                                 fontSize: "inherit",
                                                 height: "1em",
                                                 overflow: "visible",
                                                 verticalAlign: "-.125em",
                                                 width: "1em"
                                             }}
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                  d="M498 142l-46 46c-5 5-13 5-17 0L324 77c-5-5-5-12 0-17l46-46c19-19 49-19 68 0l60 60c19 19 19 49 0 68zm-214-42L22 362 0 484c-3 16 12 30 28 28l122-22 262-262c5-5 5-13 0-17L301 100c-4-5-12-5-17 0zM124 340c-5-6-5-14 0-20l154-154c6-5 14-5 20 0s5 14 0 20L144 340c-6 5-14 5-20 0zm-36 84h48v36l-64 12-32-31 12-65h36v48z"></path>
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                    <Pagination links={meta.links}/>
                </div>
            </div>
        </MainLayout>
    );
}

export default IndexPage;
