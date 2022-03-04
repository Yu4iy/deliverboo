<template>
    <div class="chekcout">
		<div class="container-fluid">
			<h2 class="my-4">Checkout</h2>
			<div class="row ">
				<!-- MAIN  -->
				<div class="col-md-12 col-lg-8 bgr p-5">
					<h4 class="border-bottom py-2">Iserischi datti</h4>
					<form class="my-3">
						<div class="row px-3 py-2 ">
							<div class="col mb-3">
								<label for="name" class="form-label">Nome</label>
								<input id="name" type="text" class="form-control" >
							</div>
							<div class="col mb-2">
								<label for="surname" class="form-label">Cognome</label>
								<input id="surname" type="text" class="form-control" >
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="email" class="form-label">Email</label>
								<input id="email" type="email" class="form-control" >
							</div>
							<div class="col mb-3">
								<label for="phone" class="form-label">Cellulare</label>
								<input id="phone" type="tel" class="form-control" >
							</div>
						</div>
						<div class="row px-3 py-2">
							<div class="col mb-2">
								<label for="adress" class="form-label">Citta - via - numero civico</label>
								<input id="adress" type="text" class="form-control" >
							</div>
						</div>

						<div class="row px-3 py-2">
							<div class="mb-3 col">
								<label for="notes" class="form-label">Informazioni aggiuntive</label>
								<textarea id="notes" class="form-control" rows="5"></textarea>
							</div>
						</div>
					</form>

				</div>

				<!-- CART -->
				<div class="col-md-12 col-lg-4 bgb">lorem</div>
			</div>
		</div>
    </div>
</template>

<script>
export default {
    name: "Checkout",
};
</script>

<style lang="scss" scoped>
.chekcout{
	// height: 100vh;
	padding: 10px 0 0 0;
}
.bgr{ background: rgba(131, 131, 131, 0.103);}
.bgb{ background: blue;}
.border-bottom{
	border-bottom: 2px solid rgba(0, 0, 0, 0.76);
}
</style>
