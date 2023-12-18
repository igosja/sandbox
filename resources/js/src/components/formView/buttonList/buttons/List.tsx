import React from "react";
import {Link, useParams} from "react-router-dom";

function List() {
    const params = useParams();
    let currentPath: string;

    if (params.id) {
        currentPath = window.location.pathname.replace('/edit/' + params.id, '');
    } else {
        currentPath = window.location.pathname.replace('/create', '');
    }

    return (
        <li className="list-inline-item">
            <Link to={currentPath} className="btn btn-default">
                List
            </Link>
        </li>
    );
}

export default React.memo(List);
