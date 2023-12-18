import React from "react";
import DataRow from "./DataRow";

function Table({config, item}) {
    return (
        <table className="table table-striped table-bordered detail-view">
            <tbody>
            {config.attributes.map(attribute => (
                <DataRow attribute={attribute} item={item}/>
            ))}
            </tbody>
        </table>
    );
}

export default React.memo(Table);
