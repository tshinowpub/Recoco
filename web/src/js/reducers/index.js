import { combineReducers } from 'redux';
import geoLocationReducer from './geolocation';

const rootReducer = combineReducers({
  geolocation: geoLocationReducer,
});

export default rootReducer;
