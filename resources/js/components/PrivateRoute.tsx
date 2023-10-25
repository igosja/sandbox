import {Navigate, Outlet, useLocation} from "react-router-dom";
import useAuth from "../hooks/useAuth";

export const PrivateRoute = () => {
    const {isAuthenticated} = useAuth();

    const location = useLocation();

    if (true === isAuthenticated) {
        return (
            <Outlet/>
        );
    } else {
        return (
            <Navigate to="/login" state={{from: location}} replace/>
        )
    }
};
