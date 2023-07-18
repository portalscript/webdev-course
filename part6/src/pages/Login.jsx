import React, { useEffect } from 'react';
import { Form, Button } from 'react-bootstrap';
import { makeRequest } from '../utils/makeRequest';
import { useNavigate } from 'react-router-dom';

const FACTIONS = [
	{ value: "COSMIC", name: "Cosmic Engineers" },
	{ value: "VOID", name: "Voidfarers" },
	{ value: "GALACTIC", name: "Galactic Alliance" },
	{ value: "QUANTUM", name: "Quantum Federation" },
	{ value: "DOMINION", name: "Stellar Dominion" },
	{ value: "ASTRO", name: "Astro-Salvage Alliance" },
	{ value: "CORSAIRS", name: "Seventh Space Corsairs" },
	{ value: "OBSIDIAN", name: "Obsidian Syndicate" },
	{ value: "AEGIS", name: "Aegis Collective" },
	{ value: "UNITED", name: "United Independent Settlements" },
	{ value: "NEWFACTION", name: "BEST FACTION EVER" },
];

export function LoginPage() {
	const [callsign, setCallsign] = React.useState('');
	const [faction, setFaction] = React.useState('');
	const navigate = useNavigate();

	useEffect(() => {
		if (window.token) {
			navigate('/contracts')
		}
	}, []);

	const handleSubmit = async (e) => {
		e.preventDefault();

		const response = await makeRequest('register', { symbol: callsign, faction }, 'POST');
		if (response.data?.token) {
			window.token = response.data.token;
			localStorage.setItem('token', token);
			alert(`This is your token:\n\n${token}\n\nSave it in a safe place.`);
			navigate('/contracts')
		}
	}
	return (
		<Form className="container center" onSubmit={handleSubmit}>
			<div style={{ maxWidth: '400px' }}>
				<div className="mt-3">
					<Form.Label htmlFor='callsign-input'>New callsign</Form.Label>
					<Form.Control value={callsign} id="callsign-input" onChange={(e) => setCallsign(e.target.value)} required />
				</div>
				<div className="mt-3">
					<Form.Label htmlFor='faction-select'>Faction</Form.Label>
					<Form.Select
						id="faction-select"
						name="faction"
						className="form-control"
						value={faction}
						onChange={(e) => setFaction(e.target.value)}
						required
					>
						<option value="">Choose a faction</option>
						{FACTIONS.map((faction) => (
							<option key={faction.value} value={faction.value}>{faction.name}</option>
						))}
					</Form.Select>
				</div>
			</div>
			<Button type="submit" variant="primary" className="mt-3">Submit</Button>
		</Form>
	);
}