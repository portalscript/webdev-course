import { renderContractPage } from "./pages/contractsPage.js";
import { renderLoginPage } from "./pages/loginPage.js";

// This variable stores your login info.
// We put it on the global "window" object so that every module can access it.
// Don't do this in real life 🙃
window.token = localStorage.getItem('token');

const container = document.getElementById('container');

function renderPage() {
	switch (location.hash) {
	case '#contracts':
		renderContractPage(container);
		break;
	case '#login':
		renderLoginPage(container);
		break;
	}
}


if (window.token) {
	location.hash = 'contracts';
} else {
	location.hash = 'login';
}

renderPage();

navigation.onnavigatesuccess = renderPage;

