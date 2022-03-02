<template>
    <section>
        <Header />
        <main>
            <router-view></router-view>
        </main>
        <Footer />
    </section>
</template>

<script>
import Header from "../components/Header";
import Footer from "../components/Footer";

export default {
    name: "App",
    components: {
        Header,
        Footer,
    },
};
</script>

<style lang="scss"></style>
