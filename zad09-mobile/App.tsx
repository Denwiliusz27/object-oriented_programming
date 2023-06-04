import { StyleSheet, Text, View } from 'react-native';
import Categories from "./components/Categories";

export default function App() {
  return (
    <View style={styles.container}>
      <View style={styles.cathegories}>
        <Text style={styles.header}>Cathegories</Text>

        <View>
          <Categories />
        </View>

      </View>
    </View>
  );
}

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
  }
});
