import React, {useState} from 'react';
import MainLayout from "../layout/MainLayout";
import Form from "react-bootstrap/Form";
import axios from "../../components/axios/Axios";
import SubmitButton from "../../components/formView/forms/elements/SubmitButton";

function ReviewPage() {
    const url = '/vf-league/reviews';

    const [validated, setValidated] = useState(false);

    const [inputs, setInputs] = useState({
        champ_id: 113695,
        tour_id: 20,
    });

    const [errors, setErrors] = useState({
        champ_id: [],
        tour_id: [],
    });

    const [reviews, setReviews] = useState([]);

    const handleChange = (event) => {
        const name = event.target.name;
        const value = event.target.value;

        setInputs(values => ({...values, [name]: value}));
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        event.stopPropagation();

        axios
            .post(url, inputs)
            .then(data => {
                setErrors({
                    champ_id: [],
                    tour_id: [],
                });

                setReviews(data.data.data[0]);

                console.log(data);
            })
            .catch(function (error) {
                setErrors({
                    champ_id: error.response.data.errors.champ_id ?? [],
                    tour_id: error.response.data.errors.tour_id ?? [],
                });
            });

        setValidated(true);
    };

    if (reviews.length) {
        return (
            <MainLayout>
                <h1 className="text-center">Review</h1>
                {reviews.map(item => (
                    <div className="row">
                        <div className="col border p-3">
                            <p>
                                <a href='javascript:' onClick={() => {
                                    navigator.clipboard.writeText(item)
                                }}>Copy</a>
                            </p>
                            {item}
                        </div>
                    </div>
                ))}
            </MainLayout>
        );
    }
    return (
        <MainLayout>
            <h1 className="text-center">Create review</h1>

            <Form noValidate validated={validated} onSubmit={handleSubmit}>
                <Form.Group className="mb-3">
                    <Form.Label>Champ_id</Form.Label>
                    <Form.Control
                        placeholder="Champ_id"
                        name="champ_id"
                        value={inputs.champ_id}
                        onChange={handleChange}
                        isInvalid={!!errors.champ_id.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.champ_id[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <Form.Group className="mb-3">
                    <Form.Label>Tour_id</Form.Label>
                    <Form.Control
                        placeholder="Tour_id"
                        name="tour_id"
                        value={inputs.tour_id}
                        onChange={handleChange}
                        isInvalid={!!errors.tour_id.length}
                    />
                    <Form.Control.Feedback type="invalid">
                        {errors.tour_id[0]}
                    </Form.Control.Feedback>
                </Form.Group>
                <SubmitButton/>
            </Form>
        </MainLayout>
    )
}

export default React.memo(ReviewPage);
