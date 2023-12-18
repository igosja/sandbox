import React from "react";
import DataColumn from "./DataColumn";
import ActionColumn from "./action/ActionColumn";

function DataRow({config, item}) {
    return (
        <tr>
            {config.columns.map(column => {
                if ('actionColumn' === column?.type) {
                    return <ActionColumn column={column} item={item}/>
                }
                return <DataColumn column={column} item={item}/>
            })}
        </tr>
    );
}

export default React.memo(DataRow);
