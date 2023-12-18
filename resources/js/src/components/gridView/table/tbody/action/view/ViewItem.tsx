import React from "react";
import {Link} from "react-router-dom";
import ViewIcon from "./ViewIcon";

function ViewItem({item}) {
    return (
        <Link to={window.location.pathname + '/' + item.id} title="Show" aria-label="Show">
            <ViewIcon/>
        </Link>
    );
}

export default React.memo(ViewItem);
