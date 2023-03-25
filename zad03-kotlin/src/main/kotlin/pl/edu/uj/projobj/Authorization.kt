package pl.edu.uj.projobj

object Authorization {
    private val users = mutableListOf<User>()
    private var user: User? = null

    init {
        users.add(User("admin", "password"))
    }

    fun login(login: String, password: String): Boolean {
        if (isUserLogged()){
            return false
        }

        for (tmpUser in users) {
            if (tmpUser.getUserLogin() == login) {
                if (tmpUser.getUserPassword() == password){
                    user = User(login, password)
                    return true
                }
            }
        }

        return false
    }

    fun isUserLogged(): Boolean {
        if (user != null) {
            return true
        } else {
            return false
        }
    }

    fun logoutUser() {
        user = null
    }
}
