import React from "react";
import {Link} from "react-router-dom";

function Create({config}) {
    if (!config.createButton) {
        return;
    }

    const currentPath = window.location.pathname + '/create';

    return (
        <li className="list-inline-item">
            <Link to={currentPath} className="btn btn-default">
                Create
            </Link>
        </li>
    );
}

export default React.memo(Create);
