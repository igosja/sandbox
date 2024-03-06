import React from "react";
import Navbar from "react-bootstrap/Navbar";
import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import NavDropdown from "react-bootstrap/NavDropdown";

function LayoutHeader() {
    return (
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
                            <Nav.Link href={'/uefa'}>
                                UEFA
                            </Nav.Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
        </header>
    );
}

export default React.memo(LayoutHeader);
