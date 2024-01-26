import React from 'react';
import GridView from "../../../components/gridView/GridView";
import {ACTION_TYPE} from "../../../components/gridView/table/tbody/action/ActionColumn";

function IndexPage() {
    return (
        <GridView config={{
            apiUrl: 'lunch/dishes',
            columns: [
                {
                    attribute: 'id',
                    contentOptions: {
                        class: 'text-center',
                    },
                    headerOptions: {
                        class: 'col-1 text-center',
                    },
                },
                {
                    attribute: 'name',
                    label: 'Назва',
                },
                {
                    attribute: 'is_ordered',
                    headerOptions: {
                        class: 'text-center',
                    },
                    label: 'Замовляв',
                },
                {
                    attribute: 'is_favorite',
                    headerOptions: {
                        class: 'text-center',
                    },
                    label: 'Фаворит',
                },
                {
                    type: ACTION_TYPE,
                    contentOptions: {
                        class: 'text-center',
                    },
                    headerOptions: {
                        class: 'col-1 col-sm-2',
                    },
                    template: '{view} {edit}',
                },
            ],
            createButton: false,
        }}/>
    );
}

export default React.memo(IndexPage);
