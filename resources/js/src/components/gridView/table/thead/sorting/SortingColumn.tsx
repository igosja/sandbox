import React from "react";
import {useSearchParams} from "react-router-dom";
import {ACTION_TYPE} from "../../tbody/action/ActionColumn";

function SortingColumn({column}) {
    const [searchParams, setSearchParams] = useSearchParams();
    const useSorting = (value) => {
        if (searchParams.get('sorting') == value) {
            value = '-' + value;
        } else if (searchParams.get('sorting') == '-' + value) {
            value = '';
        }

        searchParams.set('sorting', value);
        setSearchParams(searchParams);
    }

    if (ACTION_TYPE === column?.type) {
        return <th className={column?.headerOptions?.class}></th>
    }

    return (
        <th className={column?.headerOptions?.class}>
            <a href="javascript:" onClick={() => useSorting(column?.attribute)}>
                {column?.label}
            </a>
        </th>
    );
}

export default React.memo(SortingColumn);
