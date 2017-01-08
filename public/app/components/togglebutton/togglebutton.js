import React from 'react';

export default class Togglebutton extends React.Component {

	constructor(props) {
		super(props);
		this.state = {
			status: "closed"
		};
		this.toggle = this.toggle.bind(this);
	}

	toggle() {
		this.setState({
			'status': (this.state.status == "closed") ? "open" : "closed"
		});
	}

	render() {
		var self = this;
		var cn = 'glyphicon glyphicon-menu-';
		if(this.state.status == 'open')
		{
			cn += 'down';
		}
		else
		{
			cn += 'right';
		}
		return (
			<a onClick={self.toggle} href={'#'+self.props.target} className="btn btn-default" data-title={self.props.title} data-toggle="collapse" aria-expanded="false" aria-controls={this.props.target}>
				<span className={cn}></span>
				{self.props.title}
			</a>
		);
	}

}

