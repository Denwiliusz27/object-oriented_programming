package pl.edu.uj.projobj

import org.springframework.web.bind.annotation.GetMapping
import org.springframework.web.bind.annotation.RestController
import org.springframework.web.bind.annotation.PathVariable

@RestController
class ProductController {

    val test = listOf<String>("Lalka", "Dziady", "Balladyna", "Sherlock Holmes")

    val productList = listOf<Product>(
            Product("Lalka", "Boleslaw Prus", 20, 10, "Book about Izabela"),
            Product("Sherlock Holmes", "Artur Doyle", 15, 15, "Criminal book"),
            Product("Hobbit", "Tolkien", 24, 13, "Book about brave hobbits and Gandalf"),
            Product("The little prince", "Saint-Exupery", 30, 20, "")
    )


    @GetMapping("/")
    fun getAllProducts(): List<Product> {
        return productList
    }

    @GetMapping("/{id}")
    fun getProduct(@PathVariable id: Int): Product? {
        return productList.getOrNull(id)
    }
}
