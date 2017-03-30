import React from 'react';
import { Link } from 'react-router';

export default function ShopList(props) {
  const shops = props.shops.map((shop) => {
    return (
      <li key={shop.id}>
        <Link to={{pathname:`shop/${shop.id}`, state: shop}}>
          <div className="shoplist-item">
            {
              typeof shop.image_url.shop_image1 !== 'object' &&
              <p><img src={shop.image_url.shop_image1} alt={shop.name} /></p>
            }
            <dl>
              <dt>{ shop.name }</dt>
              <dd>{ shop.latitude }</dd>
              <dd>{ shop.longitude }</dd>
            </dl>
          </div>
        </Link>
      </li>
    );
  });

  return (
    <ul>{ shops }</ul>
  );
}
