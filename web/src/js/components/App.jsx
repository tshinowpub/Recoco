import React, { Component } from 'react';
import { connect } from 'react-redux';
import * as actions from '../actions';

import Map from './Map';
import ShopList from './ShopList';

class App extends Component {
  componentWillMount() {
    this.props.getGeoLocation();
  }

  getShopList(latitude, longitude) {
    this.props.fetchShopList({ latitude, longitude });
  }

  render() {
    if (this.props.geolocation.inProgress) {
      return <div>Loading...</div>;
    } else if (this.props.shops === null) {
      const { latitude, longitude } = this.props.geolocation.coords;
      this.getShopList(latitude, longitude);
      return <div>Loading...</div>;
    }

    const { latitude, longitude } = this.props.geolocation.coords;

    const markers = this.props.shops.map((shop) => {
      return {
        name: shop.name,
        label: shop.name,
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
        <ShopList shops={this.props.shops} />
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
};

export default connect(mapStateToProps, actions)(App);
