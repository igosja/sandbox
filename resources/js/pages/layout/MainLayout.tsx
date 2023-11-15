import React, {PropsWithChildren} from "react";
import 'bootstrap/dist/css/bootstrap.min.css';
import LayoutHeader from "../../components/LayoutHeader";

function MainLayout({children}: PropsWithChildren) {
    return (
        <section>
            <LayoutHeader/>
            <main id="main" className="flex-shrink-0" role="main">
                <div className="container">
                    {children}
                </div>
            </main>
            <footer id="footer" className="mt-auto py-3 bg-light">
                <div className="container">
                    <div className="row text-muted">
                        <div className="col-md-6 text-center text-md-start">&copy; Sandbox</div>
                        <div className="col-md-6 text-center text-md-end">ReactJS</div>
                    </div>
                </div>
            </footer>
        </section>
    );
}

export default React.memo(MainLayout);
