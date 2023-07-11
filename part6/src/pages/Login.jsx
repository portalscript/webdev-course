import React from 'react';
import { Form, Button } from 'react-bootstrap';
import { makeRequest } from '../utils/makeRequest';
import { useNavigate } from 'react-router-dom';

export function LoginPage() {
	const [callsign, setCallsign] = React.useState('');
	const [faction, setFaction] = React.useState('');
	const navigate = useNavigate();

	const handleSubmit = async (e) => {
		e.preventDefault();

		const response = await makeRequest('register', { symbol: callsign, faction }, 'POST');
		if (response.data?.token) {
			window.token = response.data.token;
			localStorage.setItem('token', token);
			alert(`This is your token:\n\n${token}\n\nSave it in a safe place.`);
			navigate('/')
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
					</Form.Select>
				</div>
			</div>
			<Button type="submit" variant="primary" className="mt-3">Submit</Button>
		</Form>
	);
}