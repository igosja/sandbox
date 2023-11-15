import React from 'react';
import SortingRow from "./SortingRow";
import FilterRow from "./FilterRow";

function HeaderRow({header}) {
    return (
        <thead>
        <SortingRow sorting={header}/>
        <FilterRow filters={header}/>
        </thead>
    );
}

export default React.memo(HeaderRow);
