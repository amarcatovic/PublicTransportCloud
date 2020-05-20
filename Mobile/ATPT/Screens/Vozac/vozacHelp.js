import React, { Component } from 'react';
import { Alert, Text, Button, TextInput, View, StyleSheet } from 'react-native';

export default class vozacHelp extends Component {
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
        <Text style={styles.txtHeader}>-Posao Vozača-</Text>
        <Text style={styles.txtMain}>Nakon što se ulogujete sa vašim podacima, otvorit će vam se ekran sa kamerom. Potrebno je da skenirate bilo koji QR koji se nalazi u vašem vozilu. Nakon toga imate opciju izabrati neku od relacija koje vaš prevoznik operiše. Unesite datum i vrijeme planiranog polaska i dolaska, te pritisnite na dugme za početak linije. Tokom same vožjne, imate opciju da mijnjate sljedeću stanicu. Nakon što se zautavite na stanicu, pritisnite dugme "Sljedeća Stanica" da bi korisnicima dali do znanja koja je to sljedeća stanica na koju će vaše vozilo stati. Kada završite liniju, pritisnite na dugme "Završi liniju", te ukoliko ste završili Vaš posao za taj dan, vratite se unazad i razdužite vozilo tako što ćete pritisnuti dugme "Razruži Vozilo", te onda možete izaći iz aplikacije.</Text>
        <View style={styles.footer}>
            <Text style={styles.footerTxt}>ATPT - Application That Provides Transport</Text>
            <Text style={styles.footerTxt}>By Softwaresky</Text>
        </View>
      </View>
    );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'space-between',
    backgroundColor: '#ecf0f1',
    margin: 50
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
  },
  footer: {
    justifyContent: 'center',
    alignItems: 'center' 
  },
  txtHeader: {
      fontSize: 50,
      fontWeight: 'bold'
  },
  txtMain: {
      fontSize: 25,
      fontWeight: '400',
      textAlign: 'center',
      lineHeight: 35
  },
  footerTxt: {
    fontWeight: 'bold',
    fontSize: 20,
    color: '#3366CC'
  }
});
