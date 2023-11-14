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
            {sorting.map(({label, name, empty}) => (
                empty ?
                    (<th>&nbsp;</th>)
                    :
                    (<th>
                        <a href="javascript:" onClick={() => useSorting(name)}>
                            {label}
                        </a>
                    </th>)
            ))}
        </tr>
    );
}

export default SortingRow;

