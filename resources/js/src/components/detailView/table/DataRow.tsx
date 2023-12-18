import React from "react";

function DataRow({attribute, item}) {
    let label = attribute?.label;
    let value = attribute?.attribute

    if (typeof attribute === 'string' || attribute instanceof String) {
        value = attribute;
    }

    if (!label) {
        label = value.charAt(0).toUpperCase() + value.slice(1);
    }

    label = label.replace('_', ' ');

    return (
        <tr>
            <th className={attribute?.captionOptions?.class}>
                {label}
            </th>
            <td className={attribute?.contentOptions?.class}>
                {item[value]}
            </td>
        </tr>
    );
}

export default React.memo(DataRow);
