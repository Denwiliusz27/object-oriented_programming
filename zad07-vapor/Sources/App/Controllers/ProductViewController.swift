import Fluent
import Vapor

struct ProductViewController: RouteCollection {
    func boot(routes: RoutesBuilder) throws {
        let products = routes.grouped("view", "products")
        products.get(use: homePage)

        products.group("create"){product in
            product.get(use: createForm)
            product.post(use: createProduct)
        }

        products.group("edit"){product in
            product.get(":productID", use: editForm)
            product.post(":productID", use: updateProduct)
        }


        products.group(":productID") { product in
            product.get(use: displayProductWithId)
            product.post("delete", use: deleteProduct)
        }
    }

    func homePage(req: Request) throws -> EventLoopFuture<View> {
        return Product
            .query(on: req.db)
            .all()
            .flatMap { products in
                return req.view.render("products/homepage", ["products": products])
            }
    }

    func displayProductWithId(req: Request) throws -> EventLoopFuture<View> {
        return Product.find(req.parameters.get("productID"), on: req.db)
            .flatMap { product in
                return req.view.render("products/product", ["product": product])
            }
    }

    func createProduct(req: Request) throws -> EventLoopFuture<Response> {
        let data = try req.content.decode(ProductRequest.self)
        let newProduct = Product(name: data.name, price: data.price, amount: data.amount)

        return newProduct.save(on: req.db)
            .transform(to: req.redirect(to: "/view/products"))

    }

    func createForm(req: Request) throws -> EventLoopFuture<View> {
            return req.view.render("products/create")
        }


    func editForm(req: Request) throws -> EventLoopFuture<View> {
        return Product.find(req.parameters.get("productID"), on: req.db)
            .flatMap { product in
                return req.view.render("products/edit", ["product": product])
            }
    }

    func updateProduct(req: Request) throws -> EventLoopFuture<Response> {
        let data = try req.content.decode(ProductRequest.self)

        return Product.find(req.parameters.get("productID"), on: req.db)
             .unwrap(or: Abort(.notFound))
             .flatMap { product in
                 product.name = data.name
                 product.amount = data.amount
                 product.price = data.price

                 return product.update(on: req.db)
                     .transform(to: req.redirect(to: "/view/products"))
             }
    }


    func deleteProduct(req: Request) throws -> EventLoopFuture<Response> {
        return Product.find(req.parameters.get("productID"), on: req.db)
             .unwrap(or: Abort(.notFound))
             .flatMap { product in
                 return product.delete(on: req.db)
                     .transform(to: req.redirect(to: "/view/products"))
             }
    }
}
