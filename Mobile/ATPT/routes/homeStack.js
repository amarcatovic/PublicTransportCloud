import { createStackNavigator } from '@react-navigation/stack'
import { createAppContainer } from '@react-navigation/native'
import {Login} from '../Screens/Login'

const screens = {
    Login: {
        screen: Login
    }
}

const HomeStack = createStackNavigator(screens)

export default createAppContainer(HomeStack)