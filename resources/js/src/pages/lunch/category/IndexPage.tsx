import React from 'react';
import {ACTION_TYPE} from "../../../components/gridView/table/tbody/action/ActionColumn";
import GridView from "../../../components/gridView/GridView";

function IndexPage() {
    return (
        <GridView config={{
            apiUrl: 'lunch/categories',
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
                    attribute: 'is_active',
                    headerOptions: {
                        class: 'text-center',
                    },
                    label: 'Активна',
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
