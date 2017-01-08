import React from 'react';

import DataTable from './../datatable/datatable';

export default class Users extends React.Component {

	constructor(props) {
		super(props);

		this.addUser = this.addUser.bind(this);
		this.removeUser = this.removeUser.bind(this);
	}

	formatRow(data, child){
		return (
			<tr key={data.id.toString()}>
				<td>{data.name}</td>
				<td><a href="#" onClick={child.removeRow.bind(child, data)} className="danger">Remove</a></td>
			</tr>
		);
	}

	addUser(user){
		var self = this;
		$.post(self.props.addurl, {
			'id':user.id,
			'_token':window.Laravel.csrfToken
		});
		return false;
	}

	removeUser(user){
		var self = this;
		$.ajax({
			url: self.props.removeurl+user.id,
			type: 'DELETE',
			data: {'_token':window.Laravel.csrfToken}
		});
		return false;
	}

	render () {
		return (
			<DataTable
				headline={this.props.headline}
				typeaheadurl={this.props.typeaheadurl}
				rowFormatter={this.props.formatRow}
				addcb={this.addUser}
				removecb={this.removeUser}
				columns={this.props.columns}
				dataurl={this.props.dataurl}
				initialdata={this.props.initialdata}
				typeahead={this.props.typeahead}
			/>
		);
	}
}
