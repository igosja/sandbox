import {PropsWithChildren} from "react";
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar'
import NavDropdown from 'react-bootstrap/NavDropdown';
import 'bootstrap/dist/css/bootstrap.min.css';

function MainLayout({children}: PropsWithChildren) {
    return (
        <section>
            <header id="header">
                <Navbar expand="lg" className="bg-body-tertiary">
                    <Container>
                        <Navbar.Brand href={'/'}>Sandbox</Navbar.Brand>
                        <Navbar.Toggle aria-controls="basic-navbar-nav"/>
                        <Navbar.Collapse id="basic-navbar-nav">
                            <Nav className="me-auto">
                                <Nav.Link href={'/'}>
                                    Головна
                                </Nav.Link>
                                <NavDropdown title="Обід" id="lunch-dropdown">
                                    <NavDropdown.Item href={'/lunch'}>
                                        Меню
                                    </NavDropdown.Item>
                                    <NavDropdown.Divider/>
                                    <NavDropdown.Item href={'/lunch/dishes'}>
                                        Страви
                                    </NavDropdown.Item>
                                    <NavDropdown.Item href={'/lunch/categories'}>
                                        Категорії
                                    </NavDropdown.Item>
                                </NavDropdown>
                            </Nav>
                        </Navbar.Collapse>
                    </Container>
                </Navbar>
            </header>
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

export default MainLayout;
