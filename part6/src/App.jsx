import React from 'react';
import { createHashRouter, RouterProvider, Link } from "react-router-dom";
import { LoginPage } from './pages/Login.jsx';

const router = createHashRouter([
	{
		path: "/",
		element: <div><Link to='login'>Login</Link></div>,
	},
	{
		path: "/login",
		element: <LoginPage />,
	},
]);

export function App() {
	return (
		<React.StrictMode>
			<RouterProvider router={router} />
		</React.StrictMode>
	);
}
