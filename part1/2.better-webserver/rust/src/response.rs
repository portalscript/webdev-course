use std::{collections::HashMap, fmt::Write};

use anyhow::Result;

pub enum StatusCode {
    Ok,
    NotFound,
    BadRequest,
    InternalServerError,
}

pub struct Response {
    status: StatusCode,
    headers: HashMap<String, String>,
    body: Option<String>,
}

impl Response {
    pub fn new() -> Response {
        Response {
            status: StatusCode::Ok,
            headers: HashMap::new(),
            body: None,
        }
    }

    pub fn set_status(mut self, status: StatusCode) -> Self {
        self.status = status;
        self
    }

    pub fn with_header<T1: ToString, T2: ToString>(mut self, name: T1, value: T2) -> Self {
        self.headers.insert(name.to_string(), value.to_string());
        self
    }

    pub fn with_body<T: ToString>(mut self, body: T) -> Self {
        self.body = Some(body.to_string());
        self
    }

    pub fn package(self) -> Result<String> {
        let mut s = String::new();
        /*
        Example Response:

        HTTP/1.1 200 OK
        Date: Mon, 27 Jul 2009 12:28:53 GMT
        Server: Apache/2.2.14 (Win32)
        Last-Modified: Wed, 22 Jul 2009 19:15:56 GMT
        Content-Length: 88
        Content-Type: text/html
        Connection: Closed
         */
        s.write_str("HTTP/1.1 ")?;
        match self.status {
            StatusCode::Ok => s.write_str("200 OK")?,
            StatusCode::BadRequest => s.write_str("400 Bad Request")?,
            StatusCode::NotFound => s.write_str("404 Not Found")?,
            StatusCode::InternalServerError => s.write_str("500 Internal Server Error")?,
        };
        s.write_str("\r\n")?;

        for (name, value) in self.headers {
            s.write_str(&name)?;
            s.write_str(": ")?;
            s.write_str(&value)?;
            s.write_str("\r\n")?;
        }
        // Write a blank line at the end of the headers
        s.write_str("\r\n")?;

        // if there is a body, write it!
        if let Some(body) = self.body {
            s.write_str(&body);
        }

        // Return the completed string
        Ok(s)
    }
}
