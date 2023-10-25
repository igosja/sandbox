import Card from 'react-bootstrap/Card';
import Col from 'react-bootstrap/Col';
import Row from 'react-bootstrap/Row';
import React, {useEffect, useState} from 'react';
import axios from 'axios';
import MainLayout from "../layout/MainLayout";

function ArticleIndexPage() {
    const url = '/api/articles';
    const [articles, setArticles] = useState([]);
    const fetchArticleData = () => {
        axios
            .get(url)
            .then(data => {
                setArticles(data.data.data)
            });
    };

    useEffect(() => {
        fetchArticleData();
    }, []);

    return (
        <MainLayout>
            <Row xs={1} sm={1} md={1} lg={1} xl={1} xxl={1} className="g-4">
                {articles.map(({created_at, created_by, id, rating, title, text, views}, idx) => (
                    <Col key={idx}>
                        <Card>
                            <Card.Header>
                                <Card.Link href={'/article/' + id}>
                                    {title}
                                </Card.Link>
                            </Card.Header>
                            <Card.Body>
                                <Card.Text>
                                    {text}
                                </Card.Text>
                                <Card.Text>
                                    Created by: {created_by}
                                </Card.Text>
                                <Card.Text>
                                    Created at: {created_at}
                                </Card.Text>
                                <Card.Text>
                                    Rating: {rating}
                                </Card.Text>
                                <Card.Text>
                                    Views: {views}
                                </Card.Text>
                            </Card.Body>
                        </Card>
                    </Col>
                ))}
            </Row>
        </MainLayout>
    );
}

export default ArticleIndexPage;
