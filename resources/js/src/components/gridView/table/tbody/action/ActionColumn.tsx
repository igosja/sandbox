import React from "react";
import ViewItem from "./view/ViewItem";
import EditItem from "./edit/EditItem";
import reactStringReplace from 'react-string-replace';

export const ACTION_TYPE = 'actionColumn';

function ActionColumn({column, item}) {
    let renderTemplate;
    let template = '{view} {edit} {delete}';
    if (column?.template) {
        template = column.template;
    }

    renderTemplate = reactStringReplace(template, '{view}', () => (
        <ViewItem item={item}/>
    ))
    renderTemplate = reactStringReplace(renderTemplate, '{edit}', () => (
        <EditItem item={item}/>
    ))

    return (
        <td className={column?.contentOptions?.class}>
            {renderTemplate}
        </td>
    );
}

export default React.memo(ActionColumn);
