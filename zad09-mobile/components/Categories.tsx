import {StyleSheet, Text, TouchableOpacity, View} from "react-native";
import {categories} from "../models/Category";
import {Product, products} from "../models/Product";
import {useState} from "react";
import ProductsList from "./ProductsList";

export default function Categories(){
    const [actualProducts, setProducts] = useState<Product[]>([])
    const [selectedCategory, setSelectedCategory] = useState<Number>()

    const handleDisplayTasks = (categoryId: Number) => {
        if (selectedCategory === categoryId) {
            setSelectedCategory(0)
            setProducts([])
        } else {
            setSelectedCategory(categoryId)
            const temp = products.filter((product) => product.cathegory_id === categoryId)
            if (temp){
                setProducts(temp)
            }
        }
    }

    return (
        <View style={styles.container}>
            {categories.map((category) => (
                <View key={category.id}>
                    <TouchableOpacity style={styles.category} onPress={() => handleDisplayTasks(category.id)}>
                        <Text>{category.name}</Text>
                    </TouchableOpacity>
                    {selectedCategory == category.id && actualProducts.length > 0 && <ProductsList products={actualProducts} />}
                </View>
            ))}
        </View>
    )
}

const styles = StyleSheet.create({
    container: {
        flex: 1,
        padding: 16,
    },
    category: {
        marginBottom: 14,
        padding: 12,
        backgroundColor: '#e0e0e0',
        borderRadius: 8,
        textAlign:"center",
    },
});