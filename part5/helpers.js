export function createElement(tagName, attributes, children) {
	const element = document.createElement(tagName);
	if (attributes) {
		for (const k in attributes) {
			if (k.startsWith('on')) {
				element[k] = attributes[k];
			} else if (attributes[k]) {
				element.setAttribute(k, attributes[k]);
			}
		}
	}
	if (children) {
		if (Array.isArray(children)) {
			for (const child of children) {
				element.appendChild(child);
			}
		} else if (typeof children === 'string') {
			element.appendChild(new Text(children));
		}
	}
	return element;
}


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

export function emptyElement(element) {
	while (element.hasChildNodes()) {
		element.removeChild(element.firstChild)
	}
}