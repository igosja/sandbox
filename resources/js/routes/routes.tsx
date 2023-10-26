import {Route, Routes} from 'react-router-dom';
import {PrivateRoute} from '../components/PrivateRoute';
import ArticleIndexPage from "../pages/article/ArticleIndexPage";
import ErrorPage from "../pages/site/ErrorPage";
import LoginPage from "../pages/auth/LoginPage";
import LogoutPage from "../pages/auth/LogoutPage";

const useRoutes = () => {
    return (
        <Routes>
            <Route index element={<ArticleIndexPage/>}/>
            <Route path="/" element={<ArticleIndexPage/>}/>
            <Route path="/login" element={<LoginPage/>}/>
            <Route path='*' element={<ErrorPage/>}/>

            <Route element={<PrivateRoute/>}>
                <Route path="/logout" element={<LogoutPage/>}/>
            </Route>

        </Routes>
    )
}

export default useRoutes
