package pl.edu.uj.projobj

class User(
        val login: String,
        val password: String
) {
    fun getUserLogin(): String {
        return login
    }

    fun getUserPassword(): String {
        return password
    }
}
