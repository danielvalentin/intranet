import React from 'react';
import ReactDOM from 'react-dom';
import 'jquery/dist/jquery';
import 'bootstrap/dist/js/bootstrap';

require('./../../node_modules/bootstrap/dist/css/bootstrap.min.css');
require('./test.css');

class Mybutton extends React.Component {
	render() {
		return <button className="wtf" onClick={this.clicker}>X.</button>
	}
	clicker() {
		alert('clicked again');
	}
}



