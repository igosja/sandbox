import React from "react";
import FilterColumn from "./FilterColumn";

function FilterRow({config}) {
    return (
        <tr>
            {config.columns.map(column => (
                <FilterColumn column={column}/>
            ))}
        </tr>
    );
}

export default React.memo(FilterRow);
