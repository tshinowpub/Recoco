import React, { Component } from 'react';
import { GoogleMapLoader, GoogleMap, Marker } from 'react-google-maps';

class Map extends Component {
  renderMarker(markers) {
    return markers.map((marker) => {
      return (
        <Marker
          key={marker.name}
          {...marker}
        />
      );
    });
  }

  render() {
    return (
      <GoogleMapLoader
        containerElement={
          <div
            {...this.props.containerElementProps}
            style={{
              height: '300px'
            }}
          />
        }
        googleMapElement={
          <GoogleMap
            ref={(map) => console.log(map)}
            defaultZoom={18}
            defaultCenter={{ lat: this.props.latitude, lng: this.props.longitude }}
          >
            {this.renderMarker(this.props.markers)}
          </GoogleMap>
        }
      />
    );
  }
}

export default Map;
