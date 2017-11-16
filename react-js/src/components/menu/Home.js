import React, { Component } from 'react';

class Home extends Component {
	render() {
		return (
			<div className="navbar-header">
				<button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span className="sr-only">Toggle Navigation</span>
					<span className="icon-bar"></span>
					<span className="icon-bar"></span>
					<span className="icon-bar"></span>
				</button>

				<a className="navbar-brand" href="/app">
					Laravel
				</a>
			</div>
		);
	}
}

export default Home;
