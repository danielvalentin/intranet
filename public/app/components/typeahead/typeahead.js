import React from 'react';
import 'jquery/dist/jquery';
import 'typeahead.js/dist/typeahead.bundle.min';

require('./typeahead.css');

export default class TypeAhead extends React.Component {
	constructor(props) {
		super(props);
		this.state = {
			inputVal: props.inputVal || ''
		};
		this.id = 'typeahead'+(Math.floor(Math.random() * 10000)+1);
		this.inputId = 'typeahead'+(Math.floor(Math.random() * 10000)+1);
		this.containerId = 'typeahead'+(Math.floor(Math.random() * 10000)+1);
		if(!props.dataurl || props.dataurl.length < 1)
		{
			console.error('No dataurl prop provided on the TypeAhead Component');
		}
		this.handleDataSelect = this.handleDataSelect.bind(this);
		this.sendData = this.sendData.bind(this);
	}
	sendData(object) {
		var user = this.state.inputVal;
		this.props.cb(object);
	}
	handleDataSelect(event) {
		this.setState({
			inputVal:event.target.value
		});
	}
	render() {
		return (
			<div className="typeahead-top">
				 <a className="btn btn-default btn-small" href={'#'+this.containerId} data-toggle="collapse" aria-expanded="false" aria-controls="{this.containerId}">
					<span className="glyphicon glyphicon-plus"></span>
					Add
				</a>
				<div className="typeahead-wrap collapse" id={this.containerId}>
					<div className="well">
						<label htmlFor={this.inputId}>{this.props.label}</label>
						<div id={this.id}>
							<input onChange={this.handleDataSelect} value={this.props.inputVal} id={this.inputId} className="form-control typeahead" type="text" placeholder={this.props.placeholder} />
						</div>
					</div>
				</div>
			</div>
		)
	}
	nameMatcher(objects) {
		return function(q, cb) {
			var namematches, substringRegex;
			namematches = [];
			substringRegex = new RegExp(q, 'i');
			$.each(objects, function(i, object){
				if(substringRegex.test(object.name))
				{
					namematches.push(object);
				}
			});
			cb(namematches);
		}
	}
	componentDidMount() {
		var self = this;
		$.get(this.props.dataurl, function(objects){
			$('#'+self.id+' .typeahead').typeahead({
				hint: true,
				highlight: true,
				minLength: 1
			},
			{
				name: 'data',
				source: self.nameMatcher(objects),
				displayKey:'name'
			}).bind('typeahead:select', function(ev, object){
				self.sendData(object);
				$('#'+self.id+' .typeahead').typeahead('val', '');
			});
		}, 'json');
	}
}
