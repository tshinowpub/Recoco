import React, { Component } from 'react';

export default class Shop extends Component {
  render() {
    const shop = this.props.location.state;
    console.log(shop);
    return (
      <div>
        <h1>{shop.name}</h1>
        {
          typeof shop.image_url.shop_image1 !== 'object' &&
          <p><img src={shop.image_url.shop_image1} alt={shop.name} /></p>
        }
        <p>{shop.pr.pr_long}</p>
      </div>
    );
  }
}
