// deno-lint-ignore-file

console.log('THIS IS JAVASCRIPT CODE!!!!!!');

const buttonHolder = document.getElementById('button-holder');
const buttons = buttonHolder.querySelectorAll('button');

for (let i = 0; i < buttons.length; i++) {
	const button = buttons[i];
	let counter = 0;
	button.addEventListener('click', function doTheThing(event) {
		let b = document.createElement('button');
		b.innerText = "I'm NEW HERE";
		event.target.parentElement.appendChild(b);
	});
}