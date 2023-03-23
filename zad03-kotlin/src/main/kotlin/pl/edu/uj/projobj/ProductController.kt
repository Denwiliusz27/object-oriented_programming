package pl.edu.uj.projobj

import org.springframework.web.bind.annotation.GetMapping
import org.springframework.web.bind.annotation.RestController

@RestController
class ProductController {

    val test = listOf<String>("kot", "pies", "mysz")
    @GetMapping("/")
    fun test(): String {
        return "Hello world"
    }

    @GetMapping("/{id}")
    fun getAnimal(int Id): String {
        return test[id]
    }
}
