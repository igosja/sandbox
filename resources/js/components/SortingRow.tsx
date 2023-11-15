import React from 'react';
import {useSearchParams} from "react-router-dom";

function SortingRow({sorting}) {
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

    return (
        <tr>
            {sorting.map(({sorting, label, name}) => (
                false != sorting ?
                    (<th>
                        <a href="javascript:" onClick={() => useSorting(name)}>
                            {label}
                        </a>
                    </th>)
                    :
                    (<th>&nbsp;</th>)
            ))}
        </tr>
    );
}

export default React.memo(SortingRow);
