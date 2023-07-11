import { makeRequest } from "../helpers.js";
import { renderContractPage } from "./contractsPage.js";

export function renderLoginPage(container) {
	container.innerHTML = `
		<form class="container center">
			<div style="max-width: 400px;">
				<div class="mt-3">
					<label class="form-label" for="callsign-input">New callsign</label>
					<input name="callsign" id="callsign-input" class="form-control" required>
				</div>
				<div class="mt-3">
					<label class="form-label" for="faction-select">Faction</label>
					<select name="faction" id="faction-select" class="form-control" required>
						<option selected value="">Choose a faction</option>
						<option value="COSMIC">Cosmic Engineers</option>
						<option value="VOID">Voidfarers</option>
						<option value="GALACTIC">Galactic Alliance</option>
						<option value="QUANTUM">Quantum Federation</option>
						<option value="DOMINION">Stellar Dominion</option>
						<option value="ASTRO">Astro-Salvage Alliance</option>
						<option value="CORSAIRS">Seventh Space Corsairs</option>
						<option value="OBSIDIAN">Obsidian Syndicate</option>
						<option value="AEGIS">Aegis Collective</option>
						<option value="UNITED">United Independent Settlements</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-primary mt-3">Submit</button>
		</form>
	`;
	const callsignInput = container.querySelector('#callsign-input');
	const factionSelect = container.querySelector('#faction-select');
	container.querySelector('form').onsubmit = async function(event) {
		event.preventDefault();

		const symbol = callsignInput.value;
		const faction = factionSelect.value;
		const response = await makeRequest('register', { symbol, faction }, 'POST');
		if (response.data?.token) {
			window.token = response.data.token;
			localStorage.setItem('token', token);
			alert(`This is your token:\n\n${token}\n\nSave it in a safe place.`);
			renderContractPage(container)
		}
	}
}

