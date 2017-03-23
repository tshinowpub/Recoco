import React, { Component } from 'react';
import { GoogleMapLoader, GoogleMap, Marker, InfoWindow } from 'react-google-maps';

class Map extends Component {
  componentWillMount() {
    console.log(this.props.markers[10]);
    if (!this.state) {
      this.setState(this.props);
    }
  }

  handleMarkerClick(targetMarker) {
    this.setState({
      markers: this.props.markers.map((marker) => {
        if (marker === targetMarker) {
          return {
            ...marker,
            showInfo: true,
          };
        }
        return marker;
      }),
    });
  }

  renderMarker(markers) {
    return markers.map(marker => (
      <Marker
        key={marker.name}
        {...marker}
        onClick={() => this.handleMarkerClick(marker)}
      >
        {marker.showInfo && (
          <InfoWindow>
            <div>
              <p>{marker.name}</p>
              {marker.detail && <p>{marker.detail.address}</p>}
              {marker.detail && <p>{marker.detail.tel}</p>}
            </div>
          </InfoWindow>
        )}
      </Marker>
    ));
  }

  render() {
    return (
      <GoogleMapLoader
        containerElement={
          <div style={{ height: '300px' }} />
        }
        googleMapElement={
          <GoogleMap
            defaultZoom={18}
            defaultCenter={{ lat: this.props.latitude, lng: this.props.longitude }}
          >
            {this.renderMarker(this.state.markers || this.props.markers)}
          </GoogleMap>
        }
      />
    );
  }
}

Map.propTypes = {
  latitude: React.PropTypes.number.isRequired,
  longitude: React.PropTypes.number.isRequired,
  markers: React.PropTypes.arrayOf(React.PropTypes.object.isRequired).isRequired,
};

export default Map;
