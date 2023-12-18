import React from "react";
import SortingColumn from "./SortingColumn";

function SortingRow({config}) {
    return (
        <tr>
            {config.columns.map(column => (
                <SortingColumn column={column}/>
            ))}
        </tr>
    );
}

export default React.memo(SortingRow);
