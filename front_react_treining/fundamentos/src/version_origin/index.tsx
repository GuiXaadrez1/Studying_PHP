// importamos o nosso componente princiapl aqui 
// colocamos para renderizar com o root no index.html em public

import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import AppOriginVersion from './AppVersion';
import reportWebVitals from '../reportWebVitals';

const rootOriginVersion = ReactDOM.createRoot(
  document.getElementById('rootOriginVersion') as HTMLElement
);
rootOriginVersion.render(
  <React.StrictMode>
    <AppOriginVersion />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
