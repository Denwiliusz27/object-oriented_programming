import {StyleSheet, Text, View} from "react-native";
import {basket} from "../models/Basket";

export default function BasketView(){
    return (
        <View>
            <View style={styles.container}>
                {basket.map((product) => (
                    <View style={styles.productView}>
                        <View key={product.id} style={styles.product}>
                            <Text>{product.name} ({product.price} zł)</Text>
                        </View>
                    </View>
                ))}
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        width:"100%",
        flexDirection: "column",
        paddingBottom: 15,
        paddingLeft: 30,
        paddingRight: 30,
        paddingTop: 10,
    },
    productView: {
        flexDirection: "row",
        alignItems:"center",
        width: "100%",
    },
    product: {
        marginBottom: 8,
        marginRight: 3,
        width: "100%",
        padding: 10,
        backgroundColor: '#fdf8d2',
        borderRadius: 8,
        textAlign: "center",
    }
});