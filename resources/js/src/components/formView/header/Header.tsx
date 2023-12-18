import React from 'react';
import {useParams} from "react-router-dom";

function Header({config, item}) {
    const params = useParams();

    let header = 'Create new';
    if (params.id) {
        header = item[config.h1];
    }
    return (
        <h1 className="text-center">{header}</h1>
    );
}

export default React.memo(Header);
