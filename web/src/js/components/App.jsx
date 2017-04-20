import React, { Component } from 'react';
import Header from './Header';

const AppStyles = {
  paddingTop: '56px',
};

export default class App extends Component {
  render() {
    return (
      <div style={AppStyles}>
        <Header />
        {this.props.children}
      </div>
    );
  }
}
