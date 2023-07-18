import React, { useEffect } from 'react';
import { makeRequest } from '../utils/makeRequest';

export default function ContractsPage() {

	useEffect(() => {
		makeRequest('/my/contracts').then((contracts) => {
			console.log(contracts);
		});
	}, []);

	return (
		<h1>I AM THE CONTRACTS PAGE!</h1>
	)
}

