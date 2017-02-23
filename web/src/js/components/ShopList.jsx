import React from 'react';

export default function ShopList(props) {
  const shops = props.shops.map((shop) => {
    return (
      <li key={shop.id}>
        <dl>
          <dt>{ shop.name }</dt>
          <dd>{ shop.latitude }</dd>
          <dd>{ shop.longitude }</dd>
        </dl>
      </li>
    );
  });

  return (
    <ul>{ shops }</ul>
  );
}
