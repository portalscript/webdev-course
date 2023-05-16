#!/usr/bin/env python3

import socket
from request import Request
from response import Response

# Create a network listener,
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
    elif request.path == "/home":
        response = Response(
            headers={
                "Content-Type": "text/plain",
                "Content-Length": "23",  # is this right???
            },
            body="This is the home page 🤷🏽‍♂️",
        )
    elif request.path == "/login":
        response = Response(
            headers={
                "Content-Type": "text/html",
                "Content-Length": "66",
            },
            body="<label>Username:<input /></label><label>Password:<input /></label>",
        )

    text = response.package()
    conn.sendall(text.encode(encoding="latin-1"))
