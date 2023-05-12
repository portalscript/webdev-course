use anyhow::Result;
use std::io::{BufRead, BufReader, Write};
use std::net::TcpListener;

fn main() -> Result<()> {
    let listener = TcpListener::bind("127.0.0.1:8888")?;

    // Handle each incomming connection one at a time.
    for incoming in listener.incoming() {
        // Wrap the stream in a buffered reader so we can iterate over the lines.
        let stream = incoming?;
        let mut stream = BufReader::new(stream);

        // Read all of the lines
        let mut buf = String::new();
        loop {
            buf.clear();
            stream.read_line(&mut buf)?;
            println!("{}", buf.trim_end_matches(['\r', '\n']));
            // Once we read an "empty" line, we're done
            if buf == "\r\n" {
                break;
            }
        }
        // Get our stream back from the buffered reader
        let mut stream = stream.into_inner();
        // Write our response to the TCP stream!
        let response_lines = [
            "HTTP/1.1 200 OK\r\n",
            "Content-Length: 26\r\n",
            "Connection: close\r\n",
            "Content-Type: text/html\r\n",
            "\r\n",
            "<button>Click me!</button>",
        ];
        for line in response_lines {
            stream.write_all(line.as_bytes())?;
        }
    }

    Ok(())
}
