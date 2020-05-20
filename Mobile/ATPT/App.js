import React from 'react'
import { createStackNavigator } from '@react-navigation/stack'
import { NavigationContainer } from '@react-navigation/native'
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs'

import Login from './Screens/Login'
import About from './Screens/About'
import Welcome from './Screens/Welcome'
import LoadingScreen from './Screens/LoadingScreen'

import VozacMain from './Screens/Vozac/main'
import VozacLinijaManager from './Screens/Vozac/VozacLinijaManager'
import VozacHelp from './Screens/Vozac/vozacHelp'

import TaxiVozacMain from './Screens/Taxi/main'
import KorisnikMain from './Screens/Korisnik/main'

const Tabs = createBottomTabNavigator()
const Stack = createStackNavigator()

const AppIntro = createStackNavigator()
const AppIntroScreen = () => (
  <AppIntro.Navigator>
    <AppIntro.Screen name="Welcome" component={Welcome} options={{title: 'Molimo Vas da sačekate'}}/>
    <AppIntro.Screen name="Login" component={Login} />
  </AppIntro.Navigator>
)

const VozacTabs = createBottomTabNavigator()
const VozacTabsScreen = () => (
  <VozacTabs.Navigator>
    <VozacTabs.Screen name="VozacMain" component={VozacMain} options={{title: "Vozač"}}/>
    <VozacTabs.Screen name="VozacMain2" component={VozacHelp} options={{title: "Pomoć"}}/>
  </VozacTabs.Navigator>
)


export default () => {

  const [isLoading, setIsLoading, uloga ] = React.useState(true)
  const [userToken, setUserToken] =  React.useState(null)

  const authContext = React.useMemo(() => {
    return {
      signIn: (zanimanje) => {
        setIsLoading(false)
        setUserToken('asdf')
        uloga(zanimanje)
      },
      signOut: () => {
        setIsLoading(false)
        setUserToken(null)
      }
    }
  }, [])

  React.useEffect(() => {
    setTimeout(() => {
      setIsLoading(false)
    }, 2000)
  })

  if(isLoading){
    return <LoadingScreen />
  }

  return(
      <NavigationContainer>
        <Stack.Navigator>
          <Stack.Screen name="AppIntroScreen" component={Login} options={{title: 'Dobrodošli', headerTitleStyle: { 
          textAlign:"center"}, headerStyle: {
            backgroundColor: '#3366CC',
          },headerTintColor: 'white'}}/>
          <Stack.Screen name="VozacMainTabs" component={VozacTabsScreen} options={{headerLeft: null, title: 'Glavni Izbornik', headerStyle: {
            backgroundColor: '#3366CC',
          }, headerTintColor: 'white'}}/>
          <Stack.Screen name="VozacLinijaManager" component={VozacLinijaManager} options={{title: 'Upravljanje Linijom', headerStyle: {
            backgroundColor: '#3366CC',
          }, headerTintColor: 'white'}}/>
          <Stack.Screen name="TaxiVozacMain" component={TaxiVozacMain} />
          <Stack.Screen name="KorisnikMain" component={KorisnikMain} />
       </Stack.Navigator>
      </NavigationContainer>
  )
}