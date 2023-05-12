#!/usr/bin/env python3

import socket
from request import Request
from response import Response

listener = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
listener.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

listener.bind(("127.0.0.1", 8888))
listener.listen()
print("Server listening on port 8888")

while True:
    conn, address = listener.accept()
    data = conn.recv(4096)
    raw = bytes.decode(data, encoding="latin-1")
    request = Request(raw)

    response = Response(status=404)

    if request.path == "/":
        response = Response(
            headers={
                "Content-Type": "text/plain",
                "Content-Length": "23",
            },
            body="You asked for the root!",
        )

    text = response.package()
    conn.sendall(text.encode(encoding="latin-1"))
