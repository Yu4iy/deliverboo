<template>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link :to="{ name: 'home' }">
                    <img
                        :src="require(`assets/images/logo-deliveroo.png`)"
                        alt="deliveboo-logo"
                        class="logo"
                    />
                    Deliverboo
                </router-link>
                <a href="/login">Login</a>
                <a href="/register">Register</a>x
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: "Header",
};
</script>

<style scoped lang="scss"></style>
