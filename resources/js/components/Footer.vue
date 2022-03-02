<template>
    <footer>
        <div class="footer-top">
            <div class="container px-4">
                <div class="row gx-5">
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">
                            <h5 class="title-col">Scopri DeliveBoo</h5>
                            <ul class="menu-footer">
                                <li class="menu-footer-item">
                                    <a href="#"> Investitori </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Chi siamo </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Ristoranti </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Altro </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Pressroom </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Il nostro blog </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Programmazione </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">
                            <h5 class="title-col">Note legali</h5>
                            <ul class="menu-footer">
                                <li class="menu-footer-item">
                                    <a href="#"> Termini e condizioni </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Informativa sulla privacy </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Cookies </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">
                            <h5 class="title-col">Aiuto</h5>
                            <ul class="menu-footer">
                                <li class="menu-footer-item">
                                    <a href="#">
                                        <img src="" alt="badge app store" />
                                    </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#">FAQ </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Tipi di cucina </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#"> Mappa del sito </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xs col-md-6 col-lg-3 col-footer">
                        <div class="p-3 content-col">
                            <h5 class="title-col">Porta DeliveBoo con te</h5>
                            <ul class="menu-footer">
                                <li class="menu-footer-item">
                                    <a href="#">
                                        <img
                                            src="/storage/footer/app_store.png"
                                            alt="badge App Store iOS"
                                            class="badge-footer"
                                        />
                                    </a>
                                </li>
                                <li class="menu-footer-item">
                                    <a href="#">
                                        <img
                                            src="/storage/footer/google-play-badge.png"
                                            alt="badge App Store iOS"
                                            class="badge-footer"
                                        />
                                    </a>
                                </li>
                            </ul>
                        </div>
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
            height: 285px;
            background-color: #434848;
            .title-col {
                font-weight: 700;
            }
            .menu-footer {
                list-style: none;
                margin: 0;
                .menu-footer-item {
                    margin-top: 10px;
                    a {
                        color: #fff;
                        .badge-footer {
                            max-width: 50%;
                        }
                    }
                    a:hover {
                        color: #00ccbc;
                        text-decoration: none;
                    }
                }
            }
        }
    }
    .col-footer:last-child {
        margin-bottom: 20px;
    }
}
</style>
