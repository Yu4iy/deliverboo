<template>
    <div class="container container-success">
        <h1 class="title-success">
            Ordine inviato con successo
            <i class="fa-solid fa-paper-plane icon-success"></i>
        </h1>

        <p class="content-success">
            Riceverai una mail con i dettagli del tuo ordine.
        </p>
        <p class="close-success">
            Buon appetito!
            <i class="fa-solid fa-utensils icon-close-success"></i>
        </p>
    </div>
</template>

<script>
export default {
    name: "Success",
};
</script>

<style lang="scss" scoped>
.container-success {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: calc(100vh - 60px);
    .title-success {
        text-align: center;
        margin-bottom: 25px;
        .icon-success {
            color: #32bab3;
        }
    }
    .content-success {
        font-size: 18px;
        text-align: center;
    }
    .close-success {
        font-size: 18px;
    }
    .icon-close-success {
        color: #32bab3;
    }
}
</style>
