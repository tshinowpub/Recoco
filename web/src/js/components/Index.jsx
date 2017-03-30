import React, { Component } from 'react';
import { connect } from 'react-redux';
import * as actions from '../actions';

import Map from './Map';
import ShopList from './ShopList';

class Index extends Component {
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

    const markers = this.props.shops.map(shop => ({
      detail: shop,
      name: shop.name,
      title: shop.name,
      content: shop.name,
      showInfo: false,
      icon: {
        url: 'http://icons.iconarchive.com/icons/graphicloads/food-drink/256/catering-icon.png',
        scaledSize: new google.maps.Size(20, 20),
      },
      position: {
        lat: parseFloat(shop.latitude),
        lng: parseFloat(shop.longitude),
      },
    }));
    markers.unshift(
      {
        name: '現在地',
        title: '現在地',
        showInfo: false,
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

const mapStateToProps = state => ({
  geolocation: state.geolocation,
  shops: state.shops,
});


Index.propTypes = {
  ...Index.propTypes,
};

export default connect(mapStateToProps, actions)(Index);
