import { createNavbar } from "../components/navbar.js";
import { createElement, emptyElement, makeRequest } from "../helpers.js";

export async function renderContractPage(container) {
	emptyElement(container);
	const response = await makeRequest('/my/contracts');
	console.log(response);

	container.appendChild(createNavbar());
	const cardsContainer = createElement('div', { class:'container' });
	for (const contract of response.data) {
		const card = createElement('div', { class:'row justify-content-center', }, [
			createElement('div', { class: 'col-6' }, [
				createElement('div', { class:'card', }, [
					createElement('h5', { class: 'card-header' }, `${contract.factionSymbol} CONTRACT`),
					createElement('ul', { class: 'list-group list-group-flush'}, [
						createElement('li', { class: 'list-group-item' },  `Type: ${contract.type}`),						
						...contract.terms.deliver.map((item) => (
							createElement('li', { class: 'list-group-item' }, 
								`Deliver ${item.tradeSymbol} to ${item.destinationSymbol}: ${item.unitsFulfilled} / ${item.unitsRequired}`,
							)
						)),
						createElement('li', { class: 'list-group-item' },  `Accepted: ${contract.accepted}`),						
						createElement('li', { class: 'list-group-item' },  `Fulfilled: ${contract.fulfilled}`),						
						createElement('li', { class: 'list-group-item' },  `Expiration: ${contract.expiration}`),						
					]),
					createElement('div', { class: 'card-footer' }, [
						createElement('button', { class: 'btn btn-primary', disabled: contract.accepted, onclick: async function() {
							const response = await makeRequest(`my/contracts/${contract.id}/accept`, null, 'POST');
							console.log(response);
							renderContractPage(container);

						} }, 'Accept')
					])
				]),
			]),
		]);

		cardsContainer.appendChild(card);
	}
	container.appendChild(cardsContainer);
}
