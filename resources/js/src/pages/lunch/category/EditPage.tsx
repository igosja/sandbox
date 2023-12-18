import React from 'react';
import FormView from "../../../components/formView/FromView";

function EditPage() {
    return (
        <FormView config={{
            apiUrl: 'lunch/categories',
            fields: [
                'name',
                'is_active',
            ],
        }}/>
    );
}

export default React.memo(EditPage);
