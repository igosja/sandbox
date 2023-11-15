import {useSearchParams} from "react-router-dom";
import React from "react";

function FilterRow({filters}) {
    const [searchParams, setSearchParams] = useSearchParams();
    const handleChangeFilter = (event) => {
        const name = event.target.name;
        const value = event.target.value;

        searchParams.set(name, value);
        searchParams.set('page', '1');
        setSearchParams(searchParams);
    };

    return (
        <tr className="filters">
            {filters.map(({filter, name, type}) => (
                false != filter ?
                    (<td>
                        <input
                            id={'filter-' + name}
                            type={type}
                            className="form-control"
                            name={'filters.' + name}
                            value={searchParams.get('filters.' + name)}
                            onChange={handleChangeFilter}
                        />
                    </td>)
                    :
                    (<td>&nbsp;</td>)
            ))}
        </tr>
    );
}

export default React.memo(FilterRow);
