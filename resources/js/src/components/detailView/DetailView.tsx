import React, {useEffect, useState} from "react";
import axios from "../axios/Axios";
import {useParams} from "react-router-dom";
import Header from "./header/Header";
import ButtonList from "./buttonList/ButtonList";
import Table from "./table/Table";
import MainLayout from "../../pages/layout/MainLayout";
import Placeholder from "../../components/placeholder/Placeholder";

function DetailView({config}) {
    const initConfig = {
        attributes: [],
        apiUrl: 'users',
        editButton: true,
        h1: 'name',
    };
    const currentConfig = {...initConfig, ...config};

    const [item, setItem] = useState({});

    const params = useParams();

    const fetchData = () => {
        axios
            .get(currentConfig.apiUrl + '/' + params.id)
            .then(data => {
                setItem(data.data.data)
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    if (item) {
        return (
            <MainLayout>
                <Header config={currentConfig} item={item}/>
                <ButtonList config={currentConfig}/>
                <div className="row">
                    <Table config={config} item={item}/>
                </div>
            </MainLayout>
        );
    } else {
        return (
            <Placeholder/>
        );
    }
}

export default React.memo(DetailView);
