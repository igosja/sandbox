import React from "react";
import List from "./buttons/List";
import Edit from "./buttons/Edit";

function ButtonList({config}) {
    return (
        <ul className="list-inline text-center">
            <List/>
            <Edit config={config}/>
        </ul>
    );
}

export default React.memo(ButtonList);
