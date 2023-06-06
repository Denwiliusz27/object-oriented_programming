import {StyleSheet, Text, TouchableOpacity, View} from "react-native";
import {Product} from "../models/Product";
import {basket} from "../models/Basket";
import {useState} from "react";

interface Props {
    products: Product[];
}

const ProductsList:React.FC<Props> = ({products}) => {
    const [info, setInfo] = useState("")
    const [productId, setProductId] = useState(0)

    const addProduct = (product: Product) => {
        setProductId(product.id)

        let temp = basket.find((elem) => {
            return elem.name == product.name
        })

        if (temp) {
            setInfo("Product is already in basket")
        } else {
            basket.push(product);
            setInfo("Successfuly added to basket")
        }
    }

    return(
        <View>
            <Text style={styles.header}>Products:</Text>
            <View style={styles.container}>
                {products.map((product) => (
                    <View style={styles.productWithInfo}>
                        <View style={styles.productView}>
                            <View key={product.id} style={styles.product}>
                                <Text>{product.name} ({product.price} zł)</Text>
                            </View>
                            <TouchableOpacity style={styles.addButton} onPress={() => addProduct(product)}>
                                <Text>+</Text>
                            </TouchableOpacity>
                        </View>
                        {info != "" && productId == product.id &&
                            <View style={styles.info}>
                                <Text>{info}</Text>
                            </View>
                        }
                    </View>
                ))}
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        flexDirection:"column",
        paddingBottom: 15,
        paddingLeft:20,
        paddingRight:20,
        paddingTop:10,
    },
    header: {
        fontWeight:"bold"
    },
    productView: {
        flexDirection:"row",
        width:"100%",
    },
    productWithInfo: {
        flexDirection:"column",
        width:"100%",
    },
    info: {
        paddingBottom:10,
        paddingTop:3
    },
    product: {
        marginBottom: 8,
        marginRight:3,
        width:"80%",
        padding: 10,
        backgroundColor: '#fdf8d2',
        borderRadius: 8,
        textAlign:"center",
    },
    addButton: {
        width:"20%",
        marginBottom: 8,
        padding: 10,
        backgroundColor: '#fdf8d2',
        borderRadius: 8,
        textAlign:"center",
        fontWeight: "bold",
    }
});

export default ProductsList;