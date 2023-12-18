import React from "react";
import {Link, useParams} from "react-router-dom";

function View() {
    const params = useParams();
    const currentPath: string = window.location.pathname.replace('/edit/' + params.id, '');

    if (!params.id) {
        return;
    }

    return (
        <li className="list-inline-item">
            <Link to={currentPath + '/' + params.id} className="btn btn-default">
                View
            </Link>
        </li>
    );
}

export default React.memo(View);
