import React, { Component } from 'react';
import { Alert, Text, Button, TextInput, View, StyleSheet, Image } from 'react-native';

export default class LoadingScreen extends Component {
  constructor(props) {
    super(props);
    
    this.state = {
      email: '',
      password: '',
    }
  }
  
  render() {
    return (
      <View style={styles.container}>
        <Image style={styles.tinyLogo} source={require('../imgs/logo.png')} />
        <Text style={styles.txt}>Učitavanje...</Text>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#e0e0e0',
  },
  input: {
    width: 200,
    height: 44,
    padding: 10,
    borderWidth: 1,
    borderColor: 'black',
    marginBottom: 10,
    marginTop: 10,
  },
  txt: {
      fontSize: 50,
      color: '#3366CC',
      marginTop: 50
  }
});
