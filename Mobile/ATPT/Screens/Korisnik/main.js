import React, { Component } from 'react';
import { Alert, Text, Button, TextInput, View, StyleSheet } from 'react-native';

export default class main extends Component {
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
        <Text>Korisnik</Text>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#ecf0f1',
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
  btn: {
      margin: 20,
  }
});
