import {Text, View} from "react-native";
import {Product} from "../models/Product";
interface Props {
    products: Product[];
}

const ProductsList:React.FC<Props> = ({products}) => {
    return(
        <View>
            {products.map((product) => (
                <View key={product.id}>
                    <Text>{product.name}</Text>
                </View>
            ))}
        </View>
    )
}

export default ProductsList;