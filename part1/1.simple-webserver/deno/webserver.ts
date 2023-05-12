const listener = Deno.listen({ port: 8888 });
console.log('Listening on port 8888');

// Loop forever, handing each connection one at a time.
// Press Ctrl + C to end the process.
while (true) {
	// Wait for a new connection to come in.
	const connection = await listener.accept();
	console.log('Got a new connection!\n');
	// Create a buffer to hold the entire request.
	// We're assuming the request won't be more then 4 KB.
	const buf = new Uint8Array(4096);
	// Read data into the buffer, and decode it into a string.
	await connection.read(buf);
	const requestString = new TextDecoder().decode(buf);
	// Print out the whole request.
	console.log(requestString);

	// Create a Uint8Array that represents the response we want to send back.
	const responseBytes = new TextEncoder().encode([
		"HTTP/1.1 200 OK\r\n",
		"Content-Length: 26\r\n",
		"Connection: close\r\n",
		"FOO: BAR\r\n",
		"Content-Type: text/html\r\n",
		"\r\n",
		"<button>Click me!</button>",
	].join(''))
	// Write those bytes to the connection, and close it!
	await connection.write(responseBytes);
	connection.close();
}