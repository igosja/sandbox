import {Route, Routes} from 'react-router-dom';
import {PrivateRoute} from '../components/routes/PrivateRoute';
import ErrorPage from "../pages/site/ErrorPage";
import LoginPage from "../pages/auth/LoginPage";
import LogoutPage from "../pages/auth/LogoutPage";
import HomePage from "../pages/site/HomePage";
import UefaIndexPage from "../pages/uefa/IndexPage";
import LunchCategoryIndexPage from "../pages/lunch/category/IndexPage";
import LunchCategoryViewPage from "../pages/lunch/category/ViewPage";
import LunchCategoryEditPage from "../pages/lunch/category/EditPage";
import LunchDishIndexPage from "../pages/lunch/dish/IndexPage";
import LunchDishViewPage from "../pages/lunch/dish/ViewPage";
import LunchDishEditPage from "../pages/lunch/dish/EditPage";
import LunchMenuPage from "../pages/lunch/IndexPage";
import ReviewPage from "../pages/vfleague/ReviewPage";

const useRoutes = () => {
    return (
        <Routes>
            <Route element={<PrivateRoute/>}>
                <Route index element={<HomePage/>}/>
                <Route path="/" element={<HomePage/>}/>
                <Route path="/uefa" element={<UefaIndexPage/>}/>
                <Route path="/lunch" element={<LunchMenuPage/>}/>
                <Route path="/lunch/categories" element={<LunchCategoryIndexPage/>}/>
                <Route path="/lunch/categories/:id" element={<LunchCategoryViewPage/>}/>
                <Route path="/lunch/categories/edit/:id" element={<LunchCategoryEditPage/>}/>
                <Route path="/lunch/dishes" element={<LunchDishIndexPage/>}/>
                <Route path="/lunch/dishes/:id" element={<LunchDishViewPage/>}/>
                <Route path="/lunch/dishes/edit/:id" element={<LunchDishEditPage/>}/>
                <Route path="/vf-league/review" element={<ReviewPage/>}/>
                <Route path="/logout" element={<LogoutPage/>}/>
            </Route>

            <Route path="/login" element={<LoginPage/>}/>
            <Route path='*' element={<ErrorPage/>}/>
        </Routes>
    )
}

export default useRoutes
