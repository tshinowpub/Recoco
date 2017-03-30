import React from 'react';
import { Route, IndexRoute } from 'react-router';

import App from './components/App';
import Index from './components/Index';
import Shop from './components/Shop';

export default (
  <Route path="/" component={App}>
    <IndexRoute component={Index} />
    <Route path="shop/:id" component={Shop} />
    {/* <Route path="posts/new" component={PostsNew} /> */}
  </Route>
);
