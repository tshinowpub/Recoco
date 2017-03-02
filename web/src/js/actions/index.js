import {
  GET_GEOLOCATION,
} from './types';

export function getGeoLocation() {
  const geolocation = navigator.geolocation;

  const promiseLocation = new Promise((resolve, reject) => {
    if (!geolocation) {
      reject(new Error('Not Supported'));
    }

    geolocation.getCurrentPosition((position) => {
      resolve(position);
    }, () => {
      reject(new Error('Permission denied'));
    });
  });

  return {
    type: GET_GEOLOCATION,
    payload: promiseLocation,
  };
}
