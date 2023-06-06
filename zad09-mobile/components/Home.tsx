import {StyleSheet, Text, TouchableOpacity, View} from "react-native";
import Categories from "./Categories";

const Home = ({navigation}) => {
    return (
        <View style={styles.container}>
            <View style={styles.cathegories}>
                <Text style={styles.header}>Cathegories</Text>
                <View>
                    <Categories/>
                </View>
            </View>
            <View style={styles.basket}>
                <TouchableOpacity style={styles.basketButton}
                                  onPress={() => navigation.navigate('Basket')}>
                    <Text>Basket</Text>
                </TouchableOpacity>
            </View>
        </View>
    );
}

export default Home;

const styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: '#fff',
    },

    cathegories: {
        backgroundColor: '#b6b4b4',
        padding: 10,
        margin: 20
    },

    header: {
        textAlign: "center",
        fontWeight: "bold"
    },

    basket: {
        position: "absolute",
        bottom: 60,
        width: "100%",
        flexDirection: "row",
        alignItems: "center",
        justifyContent: "center",
    },

    basketButton: {
        marginBottom: 8,
        padding: 10,
        backgroundColor: '#fdf8d2',
        borderRadius: 8,
    }
});