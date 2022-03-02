<template>
    <footer>
        <div class="footer-top">
            <div class="container px-4">
                <div class="row gx-5">
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">Custom column padding</div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">Custom column padding</div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">Custom column padding</div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">Custom column padding</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyrights">Copyrights</div>
    </footer>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style scoped lang="scss">
footer {
    padding: 30px 0;
    background-color: #2e3333;
    color: #fff;
    .col-footer {
        margin-top: 20px;
        .content-col {
            background-color: #434848;
        }
    }
    .col-footer:last-child {
        margin-bottom: 20px;
    }
}
</style>
