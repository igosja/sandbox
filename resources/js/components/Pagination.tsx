import {useSearchParams} from "react-router-dom";
import React from "react";

function Pagination({links}) {
    const [searchParams, setSearchParams] = useSearchParams();
    const paginate = (page) => {
        page = page.split('?');
        const params = new URLSearchParams(page[1]);

        searchParams.set('page', params.get('page'));
        setSearchParams(searchParams);
    }

    return (
        <nav>
            <ul className="pagination">
                {links.map(({url, label, active}) => (
                    <li className={(active ? 'active' : '') + ' page-item'} key={url}>
                        <a onClick={() => paginate((url ? url : '1'))} className="page-link">
                            {label}
                        </a>
                    </li>
                ))}
            </ul>
        </nav>
    );
}

export default React.memo(Pagination);
