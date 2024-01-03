import React from "react";
import MainLayout from "../../pages/layout/MainLayout";

function Placeholder() {
    return (
        <MainLayout>
            <span className="placeholder col-12 bg-body-tertiary"></span>
            <span className="placeholder col-12 bg-body-tertiary"></span>
            <span className="placeholder col-12 bg-body-tertiary"></span>
            <span className="placeholder col-12 bg-body-tertiary"></span>
        </MainLayout>
    );
}

export default React.memo(Placeholder);
