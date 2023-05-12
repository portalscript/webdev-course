#!/usr/bin/env python3

import socket

listener = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
listener.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)

listener.bind(("127.0.0.1", 8888))
listener.listen()
print("Server listening on port 8888")

while True:
    conn, address = listener.accept()
    data = conn.recv(4096)
    request = bytes.decode(data, encoding="latin-1")
    print(request)

    response = [
        "HTTP/1.1 200 OK",
        "Content-Length: 26",
        "Connection: close",
        "FOO: BAR",
        "Content-Type: text/html",
        "",
        "<button>Click me!</button>",
    ]

    responseBytes = "\r\n".join(response).encode(encoding="latin-1")

    conn.sendall(responseBytes)
