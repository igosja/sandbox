import {useEffect} from "react";
import {useNavigate} from "react-router-dom";
import MainLayout from "../layout/MainLayout";

function LogoutPage() {
    const navigate = useNavigate();

    useEffect(() => {
        localStorage.removeItem('access_token');
        navigate('/');
    }, [navigate])

    return (
        <MainLayout>
            Logout
        </MainLayout>
    )
}

export default LogoutPage
