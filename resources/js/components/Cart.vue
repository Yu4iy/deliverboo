<template>
    <div class="cart">
        <h1>aaaaaaaaaaaaaaaaaaaaaaaaaaa</h1>
        <div class="menu-cart d-flex flex-column justify-content-between">

            <input type="hidden" name="dishes[]" :value="dish">
               
        </div>
            
    </div>
</template>

<script>
export default {
    name: 'Cart',
    data() {
        return {
            localData: []
        };
    },
    mounted() {
        if (localStorage.getItem("localData")) {
            try {
                this.localData = JSON.parse(
                    localStorage.getItem("localData")
                );
					//  console.log(this.localData);
					this.test()
            } catch (e) {
                localStorage.removeItem("localData");
            }
        }
        console.log(localStorage.getItem("localData"))
    },
}
</script>

<style>

</style>