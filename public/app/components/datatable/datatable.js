import React from 'react';

import TypeAhead from './../typeahead/typeahead';

export default class DataTable extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			rows: [],
			page: ((props.page && parseInt(props.page) > 1) ? props.page : 0),
			limit: ((props.limit && parseInt(props.limit) > 1) ? props.limit : 15)
		};
		this.removeRow = this.removeRow.bind(this);
		this.addRow = this.addRow.bind(this);
		this.typeahead = true;
		if('typeahead' in this.props)
		{
			this.typeahead = this.props.typeahead;
		}
	}

	render() {
		var headers = this.props.columns.map((column, i) =>
			<td key={i.toString()}>{column}</td>
		);
		var headline = <h2>{this.props.headline}</h2> || '';
		var typeahead = this.typeahead ? <TypeAhead dataurl={this.props.typeaheadurl} cb={this.addRow} placeholder="Users name" buttonText="Add user" label="Name:" /> : '';
		return (
			<div>
				{headline}
				{typeahead}
				<table className="table table-striped">
					<thead>
						<tr>
							{headers}
						</tr>
					</thead>
					<tbody>
						{this.state.rows.map((row) => this.props.rowFormatter(row, this))}
					</tbody>
				</table>
			</div>
		);
	}

	addRow(row) {
		if($.grep(this.state.rows, function(obj){return obj.id == row.id;}).length == 0) // lengthy way of checking if the row already exists in the table
		{
			var rows = this.state.rows;
			rows.push(row);
			this.setState({
				ows:rows
			});
			return this.props.addcb(row);
		}
		else
		{
			alert('That\'s already added');
		}
	}

	removeRow(row, ev) {
		ev.preventDefault();
		if(confirm('Are you sure you want to remove this?'))
		{
			var remainingrows = this.state.rows.filter((existingrow) => {
				if(existingrow.id != row.id) return existingrow;
			});
			this.setState({
				rows:remainingrows
			});
			this.props.removecb(row);
		}
		return false;
	}

	componentDidMount() {
		if(!this.props.initialdata)
		{
			var url = this.props.dataurl+'?page='+this.state.page+'&limit='+this.state.limit;
			var self = this;
			$.get(url, function(data){
				var rows = [];
				for(var i=0;i<data.length;i++)
				{
					var rows = self.state.rows;
					rows.push(data[i]);
					self.setState({
						rows:rows
					});
				}
			}, 'json');
		}
		else
		{
			for(var i=0;i<this.props.initialdata.length;i++)
			{
				var rows = this.state.rows;
				rows.push(this.props.initialdata[i]);
				this.setState({
					rows:rows
				});
			}
		}
	}

}
