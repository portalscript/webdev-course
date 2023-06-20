import { makeRequest } from "../helpers.js";
import { renderContractPage } from "./contractsPage.js";

export function renderLoginPage(container) {
	
	// const callsignInput = createElement('input', {
	// 	name: 'callsign',
	// 	id: 'callsign-input',
	// 	class: 'form-control',
	// 	required: ''
	// });
	// const factionSelect = createElement('select', {
	// 	name: 'faction',
	// 	id: 'faction-select',
	// 	class: 'form-select',
	// 	required: '',
	// }, [
	// 	createElement('option', { selected: '', value: ''}, 'Choose a faction'),
	// 	createElement('option', { value: 'COSMIC'}, 'Cosmic Engineers'),
	// 	createElement('option', { value: 'VOID'}, 'Voidfarers'),
	// 	createElement('option', { value: 'GALACTIC'}, 'Galactic Alliance'),
	// 	createElement('option', { value: 'QUANTUM'}, 'Quantum Federation'),
	// 	createElement('option', { value: 'DOMINION'}, 'Stellar Dominion'),
	// 	createElement('option', { value: 'ASTRO'}, 'Astro-Salvage Alliance'),
	// 	createElement('option', { value: 'CORSAIRS'}, 'Seventh Space Corsairs'),
	// 	createElement('option', { value: 'OBSIDIAN'}, 'Obsidian Syndicate'),
	// 	createElement('option', { value: 'AEGIS'}, 'Aegis Collective'),
	// 	createElement('option', { value: 'UNITED'}, 'United Independent Settlements'),
	// ]);
	// const createAgentForm = createElement('form', {
	// 	class: 'container center',
	// 	onsubmit: async function(event) {
	// 		event.preventDefault();
	// 		const symbol = callsignInput.value;
	// 		const faction = factionSelect.value;
	// 		const response = await makeRequest('register', { symbol, faction });
	// 		if (response.data?.token) {
	// 			token = response.data.token;
	// 			localStorage.setItem('token', token);
	// 			alert(`This is your token:\n\n${token}\n\nSave it in a safe place.`);
	// 		}
	// 	},
	// }, [
	// 	createElement('div', {
	// 		style: 'max-width: 400px;'
	// 	}, [
	// 		createElement('div', { class: 'mt-3' }, [
	// 			createElement('label', {
	// 				for: 'callsign-input',
	// 				class: 'form-label',
	// 			}, [
	// 				new Text('New callsign'),
	// 			]),
	// 			callsignInput,
	// 		]),
	// 		createElement('div', { class: 'mt-3' }, [
	// 			createElement('label', {
	// 				for: 'faction-select',
	// 				class: 'form-label',
	// 			}, [
	// 				new Text('Faction'),
	// 			]),
	// 			factionSelect,
	// 		]),
	// 		createElement('button', {
	// 			type: 'submit',
	// 			class: 'btn btn-primary mt-3',
	// 		}, 'Submit'),
	// 	])
	// ]);
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

