import React from 'react';

export default class RolesTable extends React.Component {
	constructor(props){
		super(props);
		this.state = {
			rows: [],
			userroles: this.props.userroles,
			allroles: this.props.allroles
		}
		var numRows = this.props.userroles.length;
		for(var i=0;i<numRows;i++)
		{
			var row = this.props.userroles[i];
			this.state.rows.push(<RoleRow key={row.id.toString()} id={row.id} name={row.name} />);
		}
		this.rolesleft = this.rolesleft.bind(this);
	}
	rolesleft(){
		var self = this;
		/*return this.state.allroles.filter(function(a){
		});*/
		var n = self.state.allroles.filter(function(arole){
			return self.state.userroles.filter(function(urole){
				console.log(arole.id, urole.id);
				return arole.id != urole.id;
			});
		});
		console.log(n);
		return n;
	}
	render(){
		var rows = [];
		return (
			<div>
				<table className="table table-striped">
					<thead>
						<tr>
							<td>Name</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
						{this.state.rows}
					</tbody>
				</table>
				<RoleSelector roles={this.rolesleft()} />
			</div>
		);
	}
}

class RoleRow extends React.Component {
	constructor(props){
		super(props);
		this.id = this.props.id;
		this.name = this.props.name;
		this.removeRow = this.removeRow.bind(this);
	}
	removeRow(e) {
		e.preventDefault();
		if(confirm('Are you sure you want to remove the role "'+this.name+'"?'))
		{
			console.log('Removing role: '+this.id);
		}
		else
		{
			console.log('xxx');
		}
		return false;
	}
	render(){
		return (
			<tr>
				<td>
					<a href={"/roles/"+this.props.id}>{this.props.name}</a>
				</td>
				<td>
					<a href="#" onClick={this.removeRow} className="label label-danger" title="Remove this role">X</a>
				</td>
			</tr>
		);
	}
}

class RoleSelector extends React.Component {
	constructor(props){
		super(props);
		this.state = {
			options: []
		}
		for(var i=0;i<this.props.roles.length;i++)
		{
			var role = this.props.roles[i];
			this.state.options.push(<RoleOption key={role.id.toString()} id={role.id} name={role.name} />);
		}
	}
	render(){
		return (
			<div className="form-group form-inline">
				<select className="form-control">
					{this.state.options}
				</select>
				<button className="btn btn-primary">Add role</button>
			</div>
		);
	}
}

class RoleOption extends React.Component {
	render(){
		return(
			<option value={this.props.id}>{this.props.name}</option>
		);
	}
}
