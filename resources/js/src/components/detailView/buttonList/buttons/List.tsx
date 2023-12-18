import React from "react";
import {Link, useParams} from "react-router-dom";

function List() {
    const params = useParams();
    const currentPath = window.location.pathname.replace('/' + params.id, '');

    return (
        <li className="list-inline-item">
            <Link to={currentPath} className="btn btn-default">
                List
            </Link>
        </li>
    );
}

export default React.memo(List);
