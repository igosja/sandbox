import {createContext, useState} from "react";

type AuthContextType = {
    isAuthenticated: boolean;
    setAuth: (auth: boolean) => void;
};

const AuthContext = createContext<AuthContextType>({
    isAuthenticated: false,
    setAuth: () => {
    },
});

export const AuthProvider = ({children}: { children: JSX.Element }) => {
    const [isAuthenticated, setAuth] = useState<boolean>(
        !!localStorage.getItem('access_token'),
    );

    return (
        <AuthContext.Provider value={{isAuthenticated, setAuth}}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContext;
