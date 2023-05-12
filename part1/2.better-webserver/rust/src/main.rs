use anyhow::Result;
use request::Request;
use response::{Response, StatusCode};
use std::{io::Write, net::TcpListener};

mod request;
mod response;

fn main() -> Result<()> {
    let listener = TcpListener::bind("127.0.0.1:8888")?;

    // Handle each incomming connection one at a time.
    for incoming in listener.incoming() {
        // Wrap the stream in a buffered reader so we can iterate over the lines.
        let mut stream = incoming?;

        let request = request::parse(stream.try_clone()?)?;
        println!("Incoming Reques:\n{:#?}", request);

        let response = handle_request(&request);
        let response_text = response.package()?;
        println!("Response:\n{:?}", response_text);
        stream.write_all(response_text.as_bytes())?;
    }

    Ok(())
}

fn handle_request(request: &Request) -> Response {
    match request.path.as_str() {
        "/" => Response::new()
            .with_header("Content-Length", "23")
            .with_body("You asked for the root!"),
        "/home" => Response::new()
            .with_header("Content-Length", "23")
            .with_body("This is the home page 🤷🏽‍♂️"),
        "/login" => Response::new()
            .with_header("Content-Length", "66")
            .with_header("Content-Type", "text/html")
            .with_body("<label>Username:<input /></label><label>Password:<input /></label>"),
        _ => Response::new().set_status(StatusCode::NotFound),
    }
}
