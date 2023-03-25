package pl.edu.uj.projobj

import org.springframework.web.bind.annotation.GetMapping
import org.springframework.web.bind.annotation.PostMapping
import org.springframework.web.bind.annotation.RestController
import org.springframework.web.bind.annotation.PathVariable
import org.springframework.web.bind.annotation.RequestBody
import org.springframework.http.HttpStatus
import org.springframework.http.ResponseEntity

@RestController
class ProductController {

    var authorization = Authorization
    val productList = listOf<Product>(
            Product("Lalka", "Boleslaw Prus", 20, 10, "Book about Izabela"),
            Product("Sherlock Holmes", "Artur Doyle", 15, 15, "Criminal book"),
            Product("Hobbit", "Tolkien", 24, 13, "Book about brave hobbits and Gandalf"),
            Product("The little prince", "Saint-Exupery", 30, 20, "")
    )

    @GetMapping("/")
    fun getAllProducts(): ResponseEntity<List<Product>> {
        if (authorization.isUserLogged()){
            return ResponseEntity.ok(productList)
        } else {
            println("You are not logged in")
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(emptyList())
        }
    }

    @GetMapping("/{id}")
    fun getProduct(@PathVariable id: Int): ResponseEntity<Product> {
        if (authorization.isUserLogged()) {
            return ResponseEntity.ok(productList.getOrNull(id))
        } else {
            println("You are not logged in")
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(null)
        }

    }

    @PostMapping("/login")
    fun login(@RequestBody loginRequest: LoginRequest): ResponseEntity<String> {
        val loginResult = authorization.login(loginRequest.login, loginRequest.password)

        if (loginResult) {
            return ResponseEntity.ok("You logged succesfully")
        } else {
            if (authorization.isUserLogged()) {
                return ResponseEntity.status(HttpStatus.NOT_FOUND).body("You are actually logged")
            }

            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body("Invalid login data")
        }
    }
}
