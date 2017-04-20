import React, { Component } from 'react';
import { AppBar, Navigation } from 'react-toolbox';
import MdMenu from 'react-icons/lib/md/menu';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import * as actions from '../actions';
import AppBarTheme from '../themes/AppBar.scss';

class Header extends Component {
  render() {
    return (
      <AppBar theme={AppBarTheme} title="Recoco" fixed scrollHide rightIcon={<MdMenu color="#000" />} />
    );
  }
}

export default Header;
