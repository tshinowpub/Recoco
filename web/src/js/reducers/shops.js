import {
  FETCH_SHOP_LIST,
} from '../actions/types';

export default function (state = null, action) {
  switch (action.type) {
    case FETCH_SHOP_LIST:
      return action.payload;
    default:
      return state;
  }
}
