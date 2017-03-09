import {
  GET_GEOLOCATION,
} from '../actions/types';

const INITIAL_STATE = {
  coords: {
    latitude: null,
    longitude: null,
  },
  inProgress: true,
};

export default function (state = INITIAL_STATE, action) {
  switch (action.type) {
    case GET_GEOLOCATION:
      return action.payload;
    default:
      return state;
  }
}
