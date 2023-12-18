import React from "react";

function Header({config, item}) {
    return (
        <h1 className="text-center">{item[config.h1]}</h1>
    );
}

export default React.memo(Header);
