import React from 'react';
import DetailView from "../../../components/detailView/DetailView";

function ViewPage() {
    return (
        <DetailView config={{
            apiUrl: 'lunch/dishes',
            attributes: [
                {
                    captionOptions: {
                        class: 'col-6',
                    },
                    attribute: 'id',
                },
                'name',
                'category_id',
                'is_active',
                'is_ordered',
                'is_favorite',
                'created_at',
                'updated_at',
            ],
        }}/>
    );
}

export default React.memo(ViewPage);
