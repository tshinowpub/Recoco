import React, { Component } from 'react';
import { connect } from 'react-redux';
import jsonp from 'jsonp';
import * as actions from '../actions';

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
  componentWillMount() {
    this.props.getGeoLocation();
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
    if (!this.props.geolocation.coords.latitude) {
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
    const { latitude, longitude } = this.props.geolocation.coords;
    markers.push(
      {
        name: 'current',
        label: '現在地',
        position: {
          lat: latitude,
          lng: longitude,
        },
      },
    );

    return (
      <div>
        <Map
          longitude={longitude}
          latitude={latitude}
          markers={markers}
        />
        <ShopList shops={this.state.shops} />
      </div>
    );
  }
}

const mapStateToProps = (state) => {
  return {
    geolocation: state.geolocation,
    shops: state.shops,
  };
};


App.propTypes = {
  ...App.propTypes,
  geolocation: React.PropTypes.shape({
    coords: React.PropTypes.shape({
      longitude: React.PropTypes.number,
      latitude: React.PropTypes.number,
    }),
  }),
};

export default connect(mapStateToProps, actions)(App);
