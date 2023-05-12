use std::{collections::HashMap, net::TcpStream};

use anyhow::{bail, Result};
use std::io::{BufRead, BufReader};

#[derive(Debug)]
pub struct Request {
    pub method: String,
    pub path: String,
    pub protocol: String,
    pub headers: HashMap<String, String>,
    stream: BufReader<TcpStream>,
    body_read: bool,
}

pub fn parse(stream: TcpStream) -> Result<Request> {
    let mut stream = BufReader::new(stream);
    let mut buf = String::new();
    stream.read_line(&mut buf)?;
    // Remove the \r\n
    buf.pop();
    buf.pop();
    let (method, path, protocol) = parse_first_line(&buf)?;

    let mut headers: HashMap<String, String> = HashMap::new();

    loop {
        buf.clear();
        stream.read_line(&mut buf)?;
        // Remove the \r\n
        buf.pop();
        buf.pop();
        // When we get a blank line, that's the end of the headers
        if buf == "" {
            break;
        }
        // Otherwise parse the header and put it into the HashMap
        let (name, value) = parse_header(&buf)?;
        headers.insert(name, value);
    }

    Ok(Request {
        method,
        path,
        protocol,
        headers,
        stream,
        body_read: false,
    })
}

fn parse_first_line(line: &String) -> Result<(String, String, String)> {
    let parts: Vec<&str> = line.split(' ').collect();
    if parts.len() != 3 {
        bail!("expected three parts to first line, got {}", parts.len())
    }

    Ok((
        parts[0].trim().to_string(),
        parts[1].trim().to_string(),
        parts[2].trim().to_string(),
    ))
}

fn parse_header(line: &String) -> Result<(String, String)> {
    if let Some((name, value)) = line.split_once(":") {
        Ok((name.trim().to_string(), value.trim().to_string()))
    } else {
        bail!("malformed header")
    }
}
