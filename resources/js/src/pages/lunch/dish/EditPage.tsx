import React from 'react';
import FormView from "../../../components/formView/FromView";

function EditPage() {
    return (
        <FormView config={{
            apiUrl: 'lunch/dishes',
            fields: [
                'name',
                'category_id',
                'is_ordered',
                'is_favorite',
            ],
        }}/>
    );
}

export default React.memo(EditPage);
