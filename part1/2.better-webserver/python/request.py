class Request:
    def __init__(self, raw: str) -> None:
        end_of_first_line = raw.index("\r\n")
        first_line = raw[:end_of_first_line]
        self.method, self.path, self.protocol = first_line.split(" ")

        raw = raw[end_of_first_line + 2 :]
        headers, self.body = raw.split("\r\n\r\n")
        self.headers = {}
        for header in headers.split("\r\n"):
            first_colon = header.index(":")
            name = header[:first_colon].strip()
            value = header[first_colon + 1 :].strip()
            self.headers[name] = value
