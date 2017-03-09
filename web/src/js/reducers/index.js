import { combineReducers } from 'redux';
import geoLocationReducer from './geolocation';
import shopsReducer from './shops';

const rootReducer = combineReducers({
  geolocation: geoLocationReducer,
  shops: shopsReducer,
});

export default rootReducer;
