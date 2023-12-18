import React from "react";
import {Link} from "react-router-dom";
import EditIcon from "./EditIcon";

function EditItem({item}) {
    return (
        <Link to={window.location.pathname + '/edit/' + item.id} title="Edit" aria-label="Edit">
            <EditIcon/>
        </Link>
    );
}

export default React.memo(EditItem);
