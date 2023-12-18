import React from "react";

function Header() {
    let h1: string;

    h1 = window.location.pathname.replace('/lunch', '');
    h1 = h1.replace('/', '');
    h1 = h1.charAt(0).toUpperCase() + h1.slice(1);

    return (
        <h1 className="text-center">{h1}</h1>
    );
}

export default React.memo(Header);
