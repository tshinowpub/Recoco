import jsonp from 'jsonp';

import {
  GET_GEOLOCATION,
  FETCH_SHOP_LIST,
} from './types';

function requestGeolocation() {
  return (dispatch) => {
    navigator.geolocation.getCurrentPosition((position) => {
      dispatch({
        type: GET_GEOLOCATION,
        payload: {
          coords: {
            latitude: position.coords.latitude,
            longitude: position.coords.longitude,
          },
          inProgress: false,
        },
      });
    });
  };
}

export function getGeoLocation() {
  return (dispatch) => {
    if (!navigator.geolocation) {
      return dispatch({
        type: GET_GEOLOCATION,
      });
    }
    return dispatch(requestGeolocation());
  };
}

const URL = 'https://api.gnavi.co.jp/RestSearchAPI/20150630/?';
const API_KEY = '6f78403ab1320b9db172ebac0d607e0f';
export function fetchShopList({ latitude, longitude }) {
  const requestUrl = `${URL}keyid=${API_KEY}&format=json&hit_per_page=100&latitude=${latitude}&longitude=${longitude}`;
  return (dispatch) => {
    jsonp(requestUrl, null, (err, data) => {
      if (err) {
        console.log('# fetch error');
        console.log(`API request error!: ${err.message}`);
      } else {
        console.log('# fetch success');
        dispatch({
          type: FETCH_SHOP_LIST,
          payload: data.rest,
        });
      }
    });
  };
}
