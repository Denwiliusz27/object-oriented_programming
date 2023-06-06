import {NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from "@react-navigation/native-stack";
import BasketView from "./components/BasketView";
import Home from "./components/Home";

const Stack = createNativeStackNavigator();

export default function App() {
    return(
        <NavigationContainer>
            <Stack.Navigator>
                <Stack.Screen
                    name="Home"
                    component={Home}
                />
                <Stack.Screen name="Basket" component={BasketView} />
            </Stack.Navigator>
        </NavigationContainer>
    )
}
