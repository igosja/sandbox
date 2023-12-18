import React from "react";
import List from "./buttons/List";
import View from "./buttons/View";

function ButtonList() {
    return (
        <ul className="list-inline text-center">
            <List/>
            <View/>
        </ul>
    );
}

export default React.memo(ButtonList);
