import React from "react";
import DataRow from "./DataRow";

function Tbody({config, items}) {
    return (
        <tbody>
        {items.map(item => (
            <DataRow config={config} item={item}/>
        ))}
        </tbody>
    );
}

export default React.memo(Tbody);
