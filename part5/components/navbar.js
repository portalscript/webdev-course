import { createElement } from "../helpers.js";

const tabs = [
	{
		name: "Contracts",
		url: 'contracts',
	},
	{
		name: "Ships",
		url: 'ships',
	},
];

export function createNavbar() {
	const children = [];
	for (const tab of tabs) {
		children.push(createElement('a', { class: 'nav-link', href: `#${tab.url}` }, tab.name));
	}
	return createElement('nav', { class: 'nav' }, children);
}