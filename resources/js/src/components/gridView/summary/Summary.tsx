import React from "react";

function Summary({meta}) {
    return (
        <div className="summary">
            Showed <b>{meta.from}-{meta.to}</b> from <b>{meta.total}</b>
        </div>
    );
}

export default React.memo(Summary);
