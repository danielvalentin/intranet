import React from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/js/bootstrap';

require('bootstrap/dist/css/bootstrap.min.css');
require('./test.css');

import Users from './components/users/users';
import RolesTable from './components/rolestable/rolestable';
import Togglebutton from './components/togglebutton/togglebutton';

if(document.getElementById('department-users'))
{
	var user = {
		columns: ['User', 'Actions'],
		dataurl: '/departments/'+$('#department-users').data('department')+'/users',
		typeaheadurl: '/data/users',
		formatRow:function(data, child){
			return (
				<tr key={data.id.toString()}>
					<td><a href={"/users/"+data.id}>{data.name}</a></td>
					<td><a href="#" onClick={child.removeRow.bind(child, data)} className="danger">Remove</a></td>
				</tr>
			);
		},
		addurl: '/departments/'+$('#department-users').data('department')+'/adduser',
		removeurl: '/departments/'+$('#department-users').data('department')+'/removeuser/',
		initialdata:users,
		headline:'Users',
		typeahead:true
	}
	ReactDOM.render(
		<Users {...user} />,
		document.getElementById('department-users')
	);
}

if(document.getElementById('role-users'))
{
	var roleid = $('#role-users').data('role');
	var user = {
		columns: ['User', 'Actions'],
		dataurl: '/roles/'+roleid+'/users',
		typeaheadurl: '/data/users',
		formatRow:function(data, child){
			return (
				<tr key={data.id.toString()}>
					<td><a href={"/users/"+data.id}>{data.name}</a></td>
					<td><a href="#" onClick={child.removeRow.bind(child, data)} className="danger">Remove</a></td>
				</tr>
			);
		},
		addurl: '/data/roles/'+roleid+'/adduser',
		removeurl: '/data/roles/'+roleid+'/removeuser/',
		initialdata:users,
		headline:'Users',
		typeahead:true
	}
	ReactDOM.render(
		<Users {...user} />,
		document.getElementById('role-users')
	);
}

if(document.getElementById('users'))
{
	var user = {
		columns: ['Name', 'E-mail', 'Created at', 'Logins', 'Last login'],
		dataurl: '/data/users',
		formatRow:function(data, child){
			return (
				<tr key={data.id.toString()}>
					<td><a href={"/users/"+data.id}>{data.name}</a></td>
					<td>{data.email}</td>
					<td>{data.created}</td>
					<td>{data.logins}</td>
					<td>{data.lastlogin}</td>
				</tr>
			);
		},
		initialdata:users,
		headline:'',
		typeahead:false
	}
	ReactDOM.render(
		<Users {...user} />,
		document.getElementById('users')
	);
}

if(document.getElementById('user-roles'))
{
	ReactDOM.render(
		<RolesTable userroles={userroles} allroles={allroles} />,
		document.getElementById('user-roles')
	);
}

if(document.getElementsByClassName('togglebutton'))
{
	var buttons = document.getElementsByClassName('togglebutton');
	for(var i=0;i<buttons.length;i++)
	{
		console.log(buttons[i]);
		ReactDOM.render(
			<Togglebutton target={buttons[i].dataset.target} title={buttons[i].dataset.title} />,
			buttons[i]
		);
	}
}

