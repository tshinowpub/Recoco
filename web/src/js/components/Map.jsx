import React, { Component } from 'react';
import { GoogleMapLoader, GoogleMap, Marker, InfoWindow } from 'react-google-maps';

// https://tomchentw.github.io/react-google-maps/basics/pop-up-window
class Map extends Component {
  componentWillMount() {
    if (!this.state) {
      this.setState(this.props);
    }
  }

  handleMarkerClick(targetMarker) {
    this.setState({
      markers: this.state.markers.map((marker) => {
        console.log(marker, targetMarker);
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
    return markers.map((marker) => {
      return (
        <Marker
          key={marker.name}
          {...marker}
          onClick={this.handleMarkerClick}
        >
          {marker.showInfo && (
            <InfoWindow>
              <div>{marker.name}</div>
            </InfoWindow>
          )}
        </Marker>
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
            {this.renderMarker(this.state.markers)}
          </GoogleMap>
        }
      />
    );
  }
}

export default Map;
