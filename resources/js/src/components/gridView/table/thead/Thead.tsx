import React from "react";
import SortingRow from "./sorting/SortingRow";
import FilterRow from "./filter/FilterRow";

function Thead({config}) {
    return (
        <thead>
        <SortingRow config={config}/>
        <FilterRow config={config}/>
        </thead>
    );
}

export default React.memo(Thead);
