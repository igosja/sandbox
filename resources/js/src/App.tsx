import React from 'react';
import useRoutes from "./routes/routes";
import 'bootstrap/dist/css/bootstrap.min.css';

function App() {
    const routes = useRoutes();

    return (
        <section>
            {routes}
        </section>
    );
}

export default App;
