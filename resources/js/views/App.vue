<template>
    <section class="pt-5">
        <Header />
        <main>
            <router-view></router-view>
        </main>
        <Footer />
    </section>
</template>

<script>
// import Header from "../components/Header";
import Footer from "../components/Footer";

export default {
    name: "App",
    components: {
      //   Header,
        Footer,
    },
};
</script>

<style lang="scss">
.pts-5{
	padding: 60px;
}
</style>
