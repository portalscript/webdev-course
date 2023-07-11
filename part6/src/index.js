import React from 'react';
import { createRoot } from 'react-dom/client';
import { App } from './App.jsx';
import 'bootstrap/dist/css/bootstrap.min.css';
import './main.css';

// This variable stores your login info.
// We put it on the global "window" object so that every module can access it.
// Don't do this in real life 🙃
window.token = localStorage.getItem('token');

const container = document.createElement('div');
document.body.appendChild(container);

let root = createRoot(container);
root.render(<App />);