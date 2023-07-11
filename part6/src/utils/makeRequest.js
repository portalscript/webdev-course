export async function makeRequest(path, data, method = 'GET') {
	const headers = {
		'Content-Type': 'application/json',
	};
	if (window.token) {
		headers['Authorization'] = `Bearer ${token}`;
	}
	const response = await fetch(`https://api.spacetraders.io/v2/${path}`, {
		method,
		headers,
		body: data ? JSON.stringify(data) : undefined,
	});

	const body = await response.json();
	if (body.error) {
		alert(body.error.message);
		console.log(body.error);
		throw body.error;
	}

	return body;
}