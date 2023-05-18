import Fluent
import Vapor

struct ProductRequest: Content {
    let name: String
    let price: Double
    let amount: Int
}

final class Product: Model, Content {
    static let schema = "products"

    @ID(key: .id)
    var id: UUID?

    @Field(key: "name")
    var name: String

    @Field(key: "price")
    var price: Double

    @Field(key: "amount")
    var amount: Int

    init() { }

    init(id: UUID? = nil, name: String, price: Double, amount: Int) {
        self.id = id
        self.name = name
        self.price = price
        self.amount = amount
    }
}
