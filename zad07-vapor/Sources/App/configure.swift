import NIOSSL
import Fluent
import FluentSQLiteDriver
import Leaf
import Vapor
import Redis

public func configure(_ app: Application) async throws {

    app.databases.use(.sqlite(.file("db.sqlite")), as: .sqlite)
    app.migrations.add(CreateProduct())
    app.views.use(.leaf)

    try routes(app)
}
