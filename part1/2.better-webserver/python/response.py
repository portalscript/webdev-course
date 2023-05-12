from io import StringIO

STATUS_TEXTS = {
    200: "OK",
    400: "Bad Request",
    404: "Not Found",
    500: "Internal Server Error",
}


class Response:
    def __init__(self, status=200, headers={}, body=""):
        self.status = status
        self.headers = headers
        self.body = body

    def package(self):
        buf = StringIO()
        buf.write(f"HTTP/1.1 {self.status} ")
        status_text = "Unknown"
        if self.status in STATUS_TEXTS:
            status_text = STATUS_TEXTS[self.status]
        buf.write(f"{status_text}\r\n")
        for name in self.headers:
            value = self.headers[name]
            buf.write(f"{name}: {value}\r\n")
        buf.write("\r\n")
        if self.body:
            buf.write(self.body)
        return buf.getvalue()
