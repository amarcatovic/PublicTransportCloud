import React, { useState, useEffect } from 'react';
import { Alert, Text, View, StyleSheet, Button, TouchableOpacity } from 'react-native';
import { BarCodeScanner } from 'expo-barcode-scanner';

export default function main({route, navigation}) {
  const [hasPermission, setHasPermission] = useState(null)
  const [scanned, setScanned] = useState(false)
  const [isZaduzen, setZaduzen] = useState(false)
  const [registracija, setRegistracija] = useState('')
  const [hasLinija, setLinija] = useState(false)

  const korisnik = route.params.data

  useEffect(() => {
    (async () => {
      const { status } = await BarCodeScanner.requestPermissionsAsync();
      setHasPermission(status === 'granted');
    })();
  }, []);

  const handleBarCodeScanned = ({ type, data }) => {
    setScanned(true);

    fetch('http://192.168.0.16/publictransportcloud/api/VozacVozilo/create.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({vozac_id: korisnik.id, vozilo_id: data}),
    })
    .then(response => response.json())
    .then(dataJSON => {
      setZaduzen(true)
      setRegistracija(data)
      alert(`Vozilo registracije ${data} je zaduženo! Izaberite relaciju i započnite liniju`)
    })
    .catch((error) => {
        alert("Vozilo nije zadruženo. Desila se greška. Pokušajte ponovno.")
    })
  }

  const ucitajVozacZaduzena = async () => {

    await fetch(`http://192.168.0.16/publictransportcloud/api/Vozac/zaduzeno-vozilo.php?id=${korisnik.id}`)
    .then(response => response.json())
    .then(data => {  
        setRegistracija(data.vozilo_id)
        setZaduzen(true)
        setScanned(true)
      }) 
  }

  const ucitajVozacLinija = async () => {

    await fetch(`http://192.168.0.16/publictransportcloud/api/Vozac/aktivna-linija.php?id=${korisnik.id}`)
    .then(response => response.json())
    .then(data => {  
        setLinija(true)
      }) 
  }

  const razduziVozilo = () => {

    setScanned(false)

    fetch('http://192.168.0.16/publictransportcloud/api/VozacVozilo/zavrsi-liniju.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({vozilo_id: registracija}),
    })
    .then(response => response.json())
    .then(dataJSON => {
      alert(`Razdužili ste vozilo ` + registracija)
      setZaduzen(false)
    })
    .catch((error) => {
        alert("Vozilo nije razadruženo. Desila se greška. Pokušajte ponovno." + error + registracija)
    })

  } 

  if (hasPermission === null) {
    return <Text>Requesting for camera permission</Text>;
  }
  if (hasPermission === false) {
    return <Text>No access to camera</Text>;
  }

  if(!isZaduzen)
  {
    ucitajVozacZaduzena()
    return (
      <View
        style={{
          flex: 1,
          flexDirection: 'column',
          justifyContent: 'flex-end',
        }}>
        <BarCodeScanner
          onBarCodeScanned={scanned ? undefined : handleBarCodeScanned}
          style={{flex: 1, width:'100%'}}
        />
  
        {scanned && (
          <Button title={'Tap to Scan Again'} onPress={() => setScanned(false)} />
        )}
      </View>
    )
  }
  else
  {
    ucitajVozacLinija()
    return (
      <View style={styles.container}>
        <Text style={[styles.txt, {textAlign: 'center'}]}>Zadužili ste vozilo registarskih oznaka {registracija}</Text>
        <View style={styles.btns}>
          <TouchableOpacity
            style={styles.btnNew} 
            onPress={() => navigation.navigate("VozacLinijaManager", {data: korisnik, vozilo_id: registracija})}>
              {hasLinija ? <Text style={color = 'white'}>Nastavi Liniju</Text> : <Text style={color = 'white'}>Nova Linija</Text>}
          </TouchableOpacity>
          <TouchableOpacity    
            style={styles.btnRazduzi}
            onPress={() => Alert.alert(
              "Upozorenje",
              "Da li ste sigurni da želite razdužiti vozilo registarske oznake " + registracija + "?",
              [
                  {
                  text: "Ne želim",
                  },
                  { text: "Želim", onPress: () => {
                      razduziVozilo()
                      alert("Vozilo razduženo!")
                  }}
              ],
              { cancelable: false }
          )}>
            <Text style={color = 'white'}>Razduži Vozilo</Text>
          </TouchableOpacity>
        </View>
      </View>
    )
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'space-between',
    backgroundColor: '#ecf0f1',
    padding: 100,
    backgroundColor: '#e0e0e0',
    textAlign: 'center',
    width: '100%'
  },
  btnNew: {
    backgroundColor: '#3366CC',
    color: 'white',
    padding: 20,
    borderWidth: 1,
    borderRadius:50,
    height: 30,
    alignItems:'center',
    justifyContent:'center',
    marginTop: 50,
    width: '100%'
  },
  btnRazduzi: {
    backgroundColor: '#ff6d4d',
    color: 'white',
    padding: 20,
    borderWidth: 1,
    borderRadius:50,
    height: 30,
    alignItems:'center',
    justifyContent:'center',
    marginTop: 50,
    width: '100%'
  },
  txt: {
    fontSize: 30,
    color: '#3366CC'
  },
  btns: {
    padding: 20,
    justifyContent: 'center',
    alignItems: 'center',
    width: '80%'
  }
})