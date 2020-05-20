import React, { Component } from 'react';
import { Alert, Text, Button, TextInput, View, StyleSheet,SafeAreaView, FlatList, TouchableOpacity, Image } from 'react-native';
import DatePicker from 'react-native-datepicker'

export default class VozacLinijaManager extends Component {
  constructor(props) {
    super(props)

    this.state = {
        data: this.props.route.params.data,
        loading: true,
        loadingStanice: true,
        vozilo_id: this.props.route.params.vozilo_id,       
        relacija_id: '',
        linija_id: null,
        stanicaIndex: 0,
      }
  }

  componentDidMount(){
      this.ucitajRelacije()
  }

  ucitajRelacije = async () => {

    await fetch(`http://192.168.0.16/publictransportcloud/api/Relacija/read.php?id=${this.state.data.prevoznik_id}`)
    .then(response => response.json())
    .then(data => {  
        this.setState({relacije: data.data}) 
        this.setState({loading: false})
      }) 
    .catch((err) => {  
        alert(err)
    })
  }

  ucitajVozacLinija = async () => {

    await fetch(`http://192.168.0.16/publictransportcloud/api/Vozac/aktivna-linija.php?id=${this.state.data.id}`)
    .then(response => response.json())
    .then(data => {  
        this.setState({relacija_id: data.relacija_id}) 
        this.setState({linija_id: data.linija_id})
        this.setState({vozilo_id: data.vozilo_id})
      }) 
  }

  ucitajStaniceRelacije = async () => {

    await fetch(`http://192.168.0.16/publictransportcloud/api/RelacijaStanica/readNiz.php?id=${this.state.relacija_id}`)
    .then(response => response.json())
    .then(data => {  
        this.setState({imenaStanica: data.data[0]}) 
        this.setState({idStanica: data.data[1]})
        this.setState({loadingStanice: false})
      }) 
    .catch((err) => {  
        alert(err)
    })
  }

  updateSljedecuStanicu = async () => {

    fetch('http://192.168.0.16/publictransportcloud/api/Linija/sljedeca-stanica.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({id: this.state.linija_id, stanica_id: this.state.idStanica[this.state.stanicaIndex + 1]}),
    })
    .then(response => response.json())
    .then(data => {
        
    })
    .catch((error) => {
        alert('Greška ažuriranja stanice')
    })

  }

  zavrsiLiniju = async () => {

    fetch('http://192.168.0.16/publictransportcloud/api/Linija/kraj.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({id: this.state.linija_id}),
    })
    .then(response => response.json())
    .then(data => {
        
    })
    .catch((error) => {
        alert('Greška pri završetku linije')
    })

  }

  kreirajLiniju = async () => {

    fetch('http://192.168.0.16/publictransportcloud/api/Linija/create.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({vozac_id: this.state.data.id, vozilo_id: this.state.vozilo_id, relacija_id: this.state.relacija_id, polazak: this.state.polazak, dolazak: this.state.dolazak}),
    })
    .then(response => response.json())
    .then(data => {
        this.setState({linija_id: data.id})
        alert("Linija je započeta. Vozite pažljivo")
    })
    .catch((error) => {
        alert('Desila se greška')
    })
  }
  
  render() {
      if(this.state.loading && this.state.linija_id == null)
      {
          this.ucitajVozacLinija()
          return (<View style={styles.container}><Text>Učitavanje Relacija...</Text></View>)
      }
      else if (!this.state.loading && this.state.linija_id == null)
      {
        return (
            <View style={styles.container}>
                <DatePicker
                    style={{width: 400, marginBottom: 20}}
                    date={this.state.polazak}
                    mode="datetime"
                    placeholder="Polazak"
                    format="YYYY-MM-DD HH:mm"
                    minDate="2020-05-01"
                    maxDate="2021-06-01"
                    confirmBtnText="Potvrdi"
                    cancelBtnText="Poništi"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    }}
                    onDateChange={(date) => {this.setState({polazak: date})}}
                />
                <DatePicker
                    style={{width: 400, marginBottom: 20}}
                    date={this.state.dolazak}
                    mode="datetime"
                    placeholder="Očekivani Dolazak"
                    format="YYYY-MM-DD HH:mm"
                    minDate="2020-05-01"
                    maxDate="2021-06-01"
                    confirmBtnText="Potvrdi"
                    cancelBtnText="Poništi"
                    customStyles={{
                    dateIcon: {
                        position: 'absolute',
                        left: 0,
                        top: 4,
                        marginLeft: 0
                    },
                    dateInput: {
                        marginLeft: 36
                    }
                    }}
                    onDateChange={(date) => {this.setState({dolazak: date})}}
                />
                <FlatList
                    style={{width: '90%'}}
                    data={this.state.relacije}
                    renderItem={({item}) => (
                        <TouchableOpacity
                            style={styles.relacija}
                            onPress={() => this.setState({relacija_id: item.id})}>
                            {item.vozilo == "Autobus" ? <Image style={styles.tinyLogo} source={require('../../imgs/bus.png')} /> : undefined }
                            <View style={styles.textoviRelacija}>
                                <Text style={[styles.textRelacija, {fontWeight: 'bold', fontSize: 30}]}>Relacija: {item.polaziste} - {item.odrediste}</Text>
                                <Text style={styles.textRelacija}>Tip Vozila: {item.vozilo}</Text>
                                <Text style={styles.textRelacija}>Interval: {item.interval}</Text>
                                {this.state.relacija_id == item.id ? <Text style={styles.textRelacijaOdabrana}>Odabrana</Text> : undefined}
                            </View>
                        </TouchableOpacity> 
                    )}
                    keyExtractor={item => item.id}
                    extraData={this.state}
                  />
                <TouchableOpacity
                style={styles.btnLinija}
                onPress={() => this.kreirajLiniju()}>
                    <Text style={{textAlign: 'center', fontSize: 15, color: 'white', fontWeight: 'bold'}}>Započni Liniju</Text>
                </TouchableOpacity>
            </View>
          )
        }
    else if(this.state.linija_id != null)
    {
        if(this.state.loadingStanice)
        {
            this.ucitajStaniceRelacije()
            return <Text>Spremam...</Text>
        }
        else
        {
            return (
                <View style={styles.containerLinija}>
                    <View style={styles.stanica}>
                    <Text style={{fontSize: 60, fontWeight: 'bold', textAlign: 'center'}}>Sljedeća Stanica</Text>
                    <Text style={{fontSize: 60, fontWeight: 'bold', textAlign: 'center'}}>-{this.state.imenaStanica[this.state.stanicaIndex]}-</Text>
                        <TouchableOpacity 
                        style={styles.btnSljedecaStanica}
                        onPress={() => {                    
                            this.setState(prevState => ({ stanicaIndex: (prevState.stanicaIndex + 1) % prevState.imenaStanica.length}))
                            this.updateSljedecuStanicu()}
                        }>
                            <Text style={{fontSize: 20, fontWeight: 'bold', textAlign: 'center', color: 'white'}}>Sljedeća Stanica</Text>
                        </TouchableOpacity>
                    </View>

                    <TouchableOpacity style={styles.btnZavrsiLiniju} 
                    onPress={() => Alert.alert(
                        "Upozorenje",
                        "Jeste li sigurni da želite završiti trenutnu liniju?",
                        [
                            {
                            text: "Ne želim",
                            style: "cancel"
                            },
                            { text: "Završi", onPress: () => {
                                this.zavrsiLiniju()
                                this.setState({linija_id: null})
                                alert("Linija završena!")
                             }}
                        ],
                        { cancelable: false }
                    )}>
                        <Text style={{fontSize: 20, fontWeight: 'bold', textAlign: 'center'}}>Završi Liniju</Text>
                    </TouchableOpacity>
                </View>
            )
        }
    }
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#e0e0e0',
    padding: 50
  },
  containerLinija: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'space-between',
    backgroundColor: '#e0e0e0',
    padding: 50,
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
  relacija: {
      width: '100%',
      backgroundColor: '#edebeb',
      padding: 20,
      flexDirection: 'row',
      alignItems: 'center',
      justifyContent: 'space-around',
      shadowColor: "#000",
      shadowOffset: {
        width: 0,
        height: 7,
      },
      shadowOpacity: 0.52,
      shadowRadius: 7.22,
      elevation: 1,
      borderRadius: 30,
      marginBottom: 20,
  },
  tinyLogo: {
    width: 75,
    height: 75,
    resizeMode: 'stretch',
  },
  textoviRelacija: {
  },
  textRelacija: {
    fontSize: 25,
    marginTop: 5,
    justifyContent: 'center',
    alignItems: 'center'
  },
  textRelacijaOdabrana: {
    fontSize: 25,
    marginTop: 5,
    justifyContent: 'center',
    alignItems: 'center',
    color: 'green'
  },
  btnLinija: {
      width: '80%',
      backgroundColor: '#3366CC',
      padding: 20,
      borderRadius: 90,
  },
  stanica: {
    padding: 20,
    justifyContent: 'center',
    alignItems: 'center'
  },
  btnSljedecaStanica: {
    width: '100%',
    backgroundColor: '#3366CC',
    padding: 20,
    borderRadius: 90,
    marginTop: 20
  },
  btnZavrsiLiniju: {
    width: '80%',
    backgroundColor: '#a3b500',
    padding: 20,
    borderRadius: 90,
  }
})
