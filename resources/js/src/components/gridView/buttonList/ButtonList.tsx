import React from "react";
import Create from "./buttons/Create";

function ButtonList({config}) {
    return (
        <ul className="list-inline text-center">
            <Create config={config}/>
        </ul>
    );
}

export default React.memo(ButtonList);
