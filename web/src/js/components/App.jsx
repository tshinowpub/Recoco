import React, { Component } from 'react';
import { geolocated, geoPropTypes } from 'react-geolocated';
// import axios from 'axios';
import jsonp from 'jsonp';

import Map from './Map';
import ShopList from './ShopList';

const URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/?';
const API_KEY = '6f78403ab1320b9db172ebac0d607e0f';

class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      shops: [],
    };
  }

  getShopList() {
    const url = `${URL}keyid=${API_KEY}&format=json&hit_per_page=100&latitude=${this.props.coords.latitude}&longitude=${this.props.coords.longitude}`;
    console.log(url);
    jsonp(url, null, (err, data) => {
      if (err) {
        console.log('# fetch error');
        console.log(err);
      } else {
        console.log('# fetch success');
        console.log(data);
        this.setState({
          shops: data.rest,
        });
      }
    });
  }

  render() {
    if (!this.props.coords) {
      return <div>Loading...</div>;
    } else if (this.state.shops.length === 0) {
      this.getShopList();
      return <div>Loading...</div>;
    }

    const markers = this.state.shops.map((shop) => {
      return {
        name: shop.name,
        // label: shop.name,
        content: shop.name,
        position: {
          lat: parseFloat(shop.latitude),
          lng: parseFloat(shop.longitude),
        },
      };
    });
    markers.push(
      {
        name: 'current',
        label: '現在地',
        position: {
          lat: this.props.coords.latitude,
          lng: this.props.coords.longitude,
        },
      },
    );

    return (
      <div>
        <Map
          longitude={this.props.coords.longitude}
          latitude={this.props.coords.latitude}
          markers={markers}
        />
        <ShopList shops={this.state.shops} />
      </div>
    );
  }
}

App.propTypes = { ...App.propTypes, ...geoPropTypes };

export default geolocated({
  positionOptions: {
    enableHighAccuracy: false,
  },
  userDecisionTimeout: 5000,
})(App);
