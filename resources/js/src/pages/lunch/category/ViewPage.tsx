import React from 'react';
import DetailView from "../../../components/detailView/DetailView";

function ViewPage() {
    return (
        <DetailView config={{
            apiUrl: 'lunch/categories',
            attributes: [
                {
                    captionOptions: {
                        class: 'col-6',
                    },
                    attribute: 'id',
                },
                'name',
                'is_active',
                'created_at',
                'updated_at',
            ],
        }}/>
    );
}

export default React.memo(ViewPage);
