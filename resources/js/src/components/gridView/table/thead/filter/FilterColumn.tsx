import React from "react";
import {useSearchParams} from "react-router-dom";
import {ACTION_TYPE} from "../../tbody/action/ActionColumn";

function FilterColumn({column}) {
    const [searchParams, setSearchParams] = useSearchParams();
    const handleChangeFilter = (event) => {
        const name = event.target.name;
        const value = event.target.value;

        searchParams.set(name, value);
        searchParams.set('page', '1');
        setSearchParams(searchParams);
    };

    if (ACTION_TYPE === column?.type) {
        return <th></th>
    }

    return (
        <th>
            <input
                id={'filter-' + column?.attribute}
                className="form-control"
                name={'filters.' + column?.attribute}
                value={searchParams.get('filters.' + column?.attribute)}
                onChange={handleChangeFilter}
            />
        </th>
    );
}

export default React.memo(FilterColumn);
