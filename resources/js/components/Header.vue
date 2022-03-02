<template>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <router-link :to="{ name: 'home' }" class="container-brand">
                        <img
                            src="/storage/header/logo-deliveroo-icona.png"
                            alt="deliveboo-logo"
                            class="logo"
                        />
                        deliveboo
                    </router-link>
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    aria-current="page"
                                    href="/login"
                                >
                                    <i
                                        class="fa-solid fa-arrow-right-to-bracket icon-header"
                                    ></i>

                                    Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    aria-current="page"
                                    href="/register"
                                >
                                    <i
                                        class="fa-solid fa-house icon-header"
                                    ></i>
                                    Register
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link :to="{ name: 'home' }">
                    <img
                        src="/storage/header/logo-deliveroo-icona.png"
                        alt="deliveboo-logo"
                        class="logo"
                    />
                    Deliverboo
                </router-link>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            </div>
        </nav> -->
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style scoped lang="scss">
header {
    position: fixed;
    width: 100%;
    background: #fff;
    box-shadow: rgba(60, 64, 67, 0.178) 0px 1px 2px 0px,
        rgba(60, 64, 67, 0.082) 0px 1px 3px 1px;
}
.container {
    background: #fff;
    padding: 16px 0;
    .navbar {
        .container-brand {
            width: 70%;
            color: #00ccbc;
            text-decoration: none;
            font-size: 22px;
            font-weight: 700;
            .logo {
                max-width: 60px;
            }
        }
        .navbar-collapse {
            width: 30%;
            .nav-item {
                border: 0.5px solid #acacac;
                margin-right: 20px;
                font-size: 18px;
                padding: 0 15px;
                .nav-link:hover {
                    color: #00ccbc;
                }
                .icon-header {
                    color: #00ccbc;
                    font-size: 18px;
                    margin-right: 5px;
                }
            }
            .nav-item:last-child {
                margin-right: 0px;
            }
        }
    }
}

@media screen and (max-width: 991px) {
    .container {
        .navbar {
            .navbar-collapse {
                .nav-item {
                    border: none;
                }
            }
        }
    }
}
</style>
