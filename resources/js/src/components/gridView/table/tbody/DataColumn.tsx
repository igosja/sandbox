import React from "react";

function DataColumn({column, item}) {
    return (
        <td className={column?.contentOptions?.class}>
            {item[column?.attribute]}
        </td>
    );
}

export default React.memo(DataColumn);
